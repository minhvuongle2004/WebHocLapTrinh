<?php

namespace App\Http\Controllers\User;

use App\Models\Course;
use App\Models\Payment;
use App\Models\CourseEnrolled;
use DateTime;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

date_default_timezone_set('Asia/Ho_Chi_Minh');

class VNPayController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function processPayment(Request $request)
    {
        Log::info('VNPayController::processPayment called with data: ', $request->all());

        // Validate input
        $request->validate([
            'course_id' => 'required|exists:tbl_courses,id',
            'bank_code' => 'nullable|string|in:VNPAYQR,VNBANK,INTCARD',
            'language' => 'required|in:vn,en',
            'amount' => 'required|numeric|min:1',
        ]);

        try {
            // Lấy thông tin khóa học và user
            $course = Course::findOrFail($request->course_id);
            $user = Auth::user();

            // Tạo mã giao dịch duy nhất
            do {
                $transaction_code = strtoupper(Str::random(10));
            } while (Payment::where('transaction_code', $transaction_code)->exists());

            Log::info('Creating payment with status: pending', [
                'course_id' => $course->id,
                'user_id' => $user->id,
                'transaction_code' => $transaction_code,
            ]);

            // Lưu giao dịch vào bảng Payment
            $payment = Payment::create([
                'id_course' => $course->id,
                'id_user' => $user->id,
                'payment_method' => 'vn_pay',
                'amount' => $course->price,
                'content' => "Thanh toán khóa học: {$course->title}",
                'status' => 'waiting',
                'transaction_code' => $transaction_code,
            ]);

            // Cấu hình VNPay
            $vnp_TmnCode = config('vnpay.tmn_code');
            $vnp_HashSecret = config('vnpay.hash_secret');
            $vnp_Url = config('vnpay.url');
            $vnp_Returnurl = config('vnpay.return_url');
            $expire = config('vnpay.expire', date('YmdHis', strtotime('+15 minutes'))); // Lấy từ config hoặc mặc định

            // Tham số thanh toán
            $vnp_TxnRef = $transaction_code;
            $vnp_Amount = (int) ($course->price * 100); // Đảm bảo số nguyên
            $vnp_Locale = $request->language ?? 'vn';
            $vnp_BankCode = $request->bank_code ?? '';
            $vnp_IpAddr = $request->ip();

            // Dữ liệu gửi đến VNPay
            $inputData = [
                "vnp_Version" => "2.1.0",
                "vnp_TmnCode" => $vnp_TmnCode,
                "vnp_Amount" => $vnp_Amount,
                "vnp_Command" => "pay",
                "vnp_CreateDate" => date('YmdHis'),
                "vnp_CurrCode" => "VND",
                "vnp_IpAddr" => $vnp_IpAddr,
                "vnp_Locale" => $vnp_Locale,
                "vnp_OrderInfo" => "Thanh toan GD:" . $vnp_TxnRef, // Giống code gốc
                "vnp_OrderType" => "other",
                "vnp_ReturnUrl" => $vnp_Returnurl,
                "vnp_TxnRef" => $vnp_TxnRef,
                "vnp_ExpireDate" => $expire,
            ];

            if (!empty($vnp_BankCode)) {
                $inputData['vnp_BankCode'] = $vnp_BankCode;
            }

            // Sắp xếp và tạo chữ ký (giống code gốc)
            ksort($inputData);
            $query = "";
            $i = 0;
            $hashdata = "";
            foreach ($inputData as $key => $value) {
                if ($i == 1) {
                    $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
                } else {
                    $hashdata .= urlencode($key) . "=" . urlencode($value);
                    $i = 1;
                }
                $query .= urlencode($key) . "=" . urlencode($value) . '&';
            }

            Log::info('VNPay Input Data for TxnRef ' . $vnp_TxnRef . ': ', $inputData);
            Log::info('VNPay Hash Data for TxnRef ' . $vnp_TxnRef . ': ' . $hashdata);

            // Tạo URL thanh toán
            $vnp_Url = $vnp_Url . "?" . $query;
            if ($vnp_HashSecret) {
                $vnpSecureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret);
                $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
            }

            Log::info('Redirecting to VNPay URL for TxnRef ' . $vnp_TxnRef . ': ' . $vnp_Url);
            return redirect($vnp_Url);
        } catch (\Exception $e) {
            Log::error('ProcessPayment Error for TxnRef ' . ($vnp_TxnRef ?? 'unknown') . ': ' . $e->getMessage());
            return redirect()->route('user.course-payment', $request->course_id)->with('error', 'Lỗi xử lý thanh toán. Vui lòng thử lại.');
        }
    }

    public function returnPayment(Request $request)
    {
        // Lấy cấu hình VNPay
        $vnp_HashSecret = config('vnpay.hash_secret');

        // Lọc chỉ tham số bắt đầu bằng vnp_
        $inputData = [];
        foreach ($request->query() as $key => $value) {
            if (substr($key, 0, 4) == 'vnp_') {
                $inputData[$key] = $value;
            }
        }

        // Lấy và bỏ vnp_SecureHash
        $vnp_SecureHash = $inputData['vnp_SecureHash'] ?? '';
        unset($inputData['vnp_SecureHash']);

        // Sắp xếp và tạo chữ ký
        ksort($inputData);
        $hashData = "";
        $i = 0;
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashData .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashData .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
        }

        $secureHash = hash_hmac('sha512', $hashData, $vnp_HashSecret);

        // Tìm giao dịch
        $payment = Payment::where('transaction_code', $inputData['vnp_TxnRef'] ?? '')->first();

        // Chuẩn bị dữ liệu cho view
        $responseData = [
            'vnp_TxnRef' => $inputData['vnp_TxnRef'] ?? '',
            'vnp_Amount' => isset($inputData['vnp_Amount']) ? ($inputData['vnp_Amount'] / 100) : '',
            'vnp_OrderInfo' => $inputData['vnp_OrderInfo'] ?? '',
            'vnp_ResponseCode' => $inputData['vnp_ResponseCode'] ?? '',
            'vnp_TransactionNo' => $inputData['vnp_TransactionNo'] ?? '',
            'vnp_BankCode' => $inputData['vnp_BankCode'] ?? '',
            'vnp_PayDate' => $inputData['vnp_PayDate'] ?? '',
            'result' => '',
            'payment' => $payment,
            'course' => $payment ? $payment->course : null,
        ];

        // Kiểm tra chữ ký và giao dịch
        if ($secureHash === $vnp_SecureHash && $payment) {
            // Cập nhật thông tin giao dịch
            $payment->vnp_transaction_no = $inputData['vnp_TransactionNo'] ?? null;
            $payment->vnp_response_code = $inputData['vnp_ResponseCode'] ?? null;
            $payment->vnp_bank_code = $inputData['vnp_BankCode'] ?? null;

            if ($inputData['vnp_ResponseCode'] == '00') {
                $payment->status = 'success'; // Khớp với ENUM
                $payment->save();

                $months = (int) $payment->course->expiration_date; // Ép kiểu thành số nguyên
                $expirationDate = (new DateTime())->modify("+{$months} months")->format('Y-m-d H:i:s');

                CourseEnrolled::updateOrCreate(
                    [
                        'id_user' => $payment->id_user,
                        'id_course' => $payment->id_course,
                        'title_course' => $payment->course->title,
                        'expiration_date' => $expirationDate,
                    ],
                    [
                        'status' => 'in_progess', // Hoặc 'active' tùy theo logic của bạn
                    ]
                );

                $responseData['result'] = "<span style='color:blue'>GD Thanh cong</span>";
                session()->flash('success', 'Thanh toán thành công! Bạn đã được đăng ký khóa học.');
            } else {
                $payment->status = 'canceled'; // Khớp với ENUM
                $payment->save();

                $responseData['result'] = "<span style='color:red'>GD Khong thanh cong</span>";
                session()->flash('error', 'Thanh toán không thành công! Vui lòng thử lại.');
            }
        } else {
            $responseData['result'] = "<span style='color:red'>Chu ky khong hop le</span>";
            session()->flash('error', 'Lỗi xác thực giao dịch! Vui lòng thử lại.');
        }


        // Trả về view duy nhất
        return redirect()->route('user.index', $responseData);
    }

    public function ipn(Request $request)
    {
        Log::info('VNPayController::ipn called with data: ', $request->all());

        $vnp_HashSecret = config('vnpay.hash_secret');
        $inputData = [];
        foreach ($request->all() as $key => $value) {
            if (substr($key, 0, 4) == 'vnp_') {
                $inputData[$key] = $value;
            }
        }

        $vnp_SecureHash = $inputData['vnp_SecureHash'] ?? '';
        unset($inputData['vnp_SecureHash']);
        ksort($inputData);
        $hashData = '';
        $i = 0;
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashData .= '&' . urlencode($key) . '=' . urlencode($value);
            } else {
                $hashData .= urlencode($key) . '=' . urlencode($value);
                $i = 1;
            }
        }

        $secureHash = hash_hmac('sha512', $hashData, $vnp_HashSecret);
        $payment = Payment::where('transaction_code', $inputData['vnp_TxnRef'])->first();

        try {
            if ($secureHash === $vnp_SecureHash && $payment) {
                if ($payment->amount == $inputData['vnp_Amount'] / 100) {
                    if ($payment->status == 'pending') {
                        if ($inputData['vnp_ResponseCode'] == '00' && $inputData['vnp_TransactionStatus'] == '00') {
                            $payment->status = 'completed';
                            $payment->vnp_transaction_no = $inputData['vnp_TransactionNo'];
                            $payment->vnp_bank_code = $inputData['vnp_BankCode'];
                            $payment->vnp_response_code = $inputData['vnp_ResponseCode'];
                            $payment->save();

                            CourseEnrolled::updateOrCreate(
                                [
                                    'user_id' => $payment->id_user,
                                    'course_id' => $payment->id_course,
                                ],
                                [
                                    'status' => 'active',
                                ]
                            );

                            Log::info('IPN: Payment ' . $payment->transaction_code . ' updated to completed');
                            return response()->json([
                                'RspCode' => '00',
                                'Message' => 'Confirm Success',
                            ]);
                        } else {
                            $payment->status = 'cancelled';
                            $payment->vnp_transaction_no = $inputData['vnp_TransactionNo'];
                            $payment->vnp_bank_code = $inputData['vnp_BankCode'];
                            $payment->vnp_response_code = $inputData['vnp_ResponseCode'];
                            $payment->save();

                            Log::info('IPN: Payment ' . $payment->transaction_code . ' updated to failed');
                            return response()->json([
                                'RspCode' => '00',
                                'Message' => 'Confirm Success',
                            ]);
                        }
                    } else {
                        return response()->json([
                            'RspCode' => '02',
                            'Message' => 'Payment already confirmed',
                        ]);
                    }
                } else {
                    return response()->json([
                        'RspCode' => '04',
                        'Message' => 'Invalid amount',
                    ]);
                }
            } else {
                return response()->json([
                    'RspCode' => '97',
                    'Message' => 'Invalid signature or payment not found',
                ]);
            }
        } catch (\Exception $e) {
            Log::error('IPN Error: ' . $e->getMessage());
            return response()->json([
                'RspCode' => '99',
                'Message' => 'Unknown error',
            ]);
        }
    }

    protected function callApi($method, $url, $data)
    {
        $curl = curl_init();
        switch ($method) {
            case "POST":
                curl_setopt($curl, CURLOPT_POST, 1);
                if ($data) {
                    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
                }
                break;
            default:
                if ($data) {
                    $url = sprintf("%s?%s", $url, http_build_query($data));
                }
        }

        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

        $result = curl_exec($curl);
        if (!$result) {
            Log::error('cURL Error: ' . curl_error($curl));
            throw new \Exception('Connection Failure');
        }
        curl_close($curl);
        return $result;
    }
}