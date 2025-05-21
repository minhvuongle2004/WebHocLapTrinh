<?php

namespace App\Http\Controllers\User;

use App\Models\Course;
use App\Models\CourseEnrolled;
use App\Models\Payment;
use DateTime;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Str;

class PaymentUserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function course_payment($id)
    {
        $user = auth()->user();
        $course = Course::findOrFail($id);

        if ($course->price === 0 || $course->is_free == 1) {
            $months = (int) $course->expiration_date; // Ép kiểu thành số nguyên
            $expirationDate = (new DateTime())->modify("+{$months} months")->format('Y-m-d H:i:s');
            CourseEnrolled::updateOrCreate(
                [
                    'id_user' => $user->id,
                    'id_course' => $course->id,
                    'title_course' => $course->title,
                    'expiration_date' => $expirationDate,
                ],
                [
                    'status' => 'in_progess', // Hoặc 'active' tùy theo logic của bạn
                ]
            );

            return redirect()->route('user.index', $id)->with('success', 'Bãn đã nhận thành công 1 khoá học miễn phí!');
        }

        return view('user.themes.payment.course-payment', compact('user', 'course'));
    }

    public function processPayment(Request $request)
    {
        Log::info('PaymentUserController::processPayment called with data: ', $request->all());

        $request->validate([
            'course_id' => 'required|exists:tbl_courses,id',
            'payment_method' => 'required|in:vn_pay,banking',
        ]);

        $user = auth()->user();
        $course = Course::findOrFail($request->course_id);
        $paymentMethod = $request->payment_method;

        if ($paymentMethod == 'vn_pay') {
            Log::info('Redirecting to vnpay_form for course: ' . $course->id);
            return view('user.themes.vnpay.form', compact('user', 'course'));
        } elseif ($paymentMethod == 'banking') {
            $bankCode = 'bidv';
            $accountNumber = '4511092520';
            $amount = $course->price;
            $content = 'MaKH ' . $user->id . ' Ten ' . $user->fullname . ' MaKHOA ' . $course->id;

            $qrUrl = "https://img.vietqr.io/image/{$bankCode}-{$accountNumber}-compact.png?amount={$amount}&addInfo=" . urlencode($content);

            Log::info('Redirecting to banking view for course: ' . $course->id);
            return view('user.themes.payment.banking', compact('user', 'course', 'qrUrl', 'content', 'amount'));
        } else {
            Log::error('Invalid payment method: ' . $paymentMethod);
            return redirect()->route('user.course-payment', $request->course_id)->with('error', 'Phương thức thanh toán không hợp lệ!');
        }
    }

    public function confirmBanking(Request $request)
    {
        Log::info('PaymentUserController::confirmBanking called with data: ', $request->all());

        $user = auth()->user();
        $courseId = $request->course_id;

        $exists = Payment::where('id_user', $user->id)
            ->where('id_course', $courseId)
            ->where('payment_method', 'banking')
            ->exists();

        if ($exists) {
            return redirect()->route('user.index')->with('error', 'Bạn đã xác nhận thanh toán cho khóa học này rồi!');
        }

        Payment::create([
            'id_user' => $user->id,
            'id_course' => $courseId,
            'payment_method' => 'banking',
            'content' => $request->content,
            'amount' => $request->amount,
            'status' => 'waiting',
            'transaction_code' => strtoupper(Str::random(10)),
        ]);

        return redirect()->route('user.index')->with('success', 'Yêu cầu của bạn sẽ được duyệt sau 1 tiếng!');
    }
}