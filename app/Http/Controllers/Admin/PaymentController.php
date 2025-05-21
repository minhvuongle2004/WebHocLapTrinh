<?php

namespace App\Http\Controllers\Admin;

use App\Models\CourseEnrolled;
use App\Models\Payment;
use App\Models\User;
use App\Models\Course;
use DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PaymentController extends Controller
{
    // Hiển thị danh sách tất cả thanh toán
    public function index()
    {
        $payments = Payment::with(['user', 'course'])->get(); // ✅ Load luôn thông tin user và course
        return view('admin.themes.payments.tablePayment', compact('payments'));
    }

    // Hiển thị chi tiết một thanh toán
    public function show($id)
    {
        $payment = Payment::with(['user', 'course'])->findOrFail($id); // ✅ Load thông tin khóa học và user
        return view('admin.themes.payments.paymentDetail', compact('payment'));
    }

    // Hiển thị form tạo thanh toán mới
    public function create()
    {
        $users = User::all(); // ✅ Lấy danh sách người dùng
        $courses = Course::all(); // ✅ Lấy danh sách khóa học
        return view('admin.themes.payments.createPayment', compact('users', 'courses'));
    }

    // Lưu thanh toán mới vào database
    public function store(Request $request)
    {
        $request->validate([
            'id_user' => 'required|exists:tbl_users,id',
            'id_course' => 'required|exists:tbl_courses,id',
            'payment_method' => 'required|in:vn_pay,banking',
            'amount' => 'required|numeric|min:0',
            'status' => 'required|in:waiting,success,canceled',
        ]);

        try {
            $course = Course::findOrFail($request->id_course);

            if ($request->status === 'canceled') {
                $finalStatus = 'canceled';
            } else {
                $finalStatus = ($request->amount >= $course->price) ? 'success' : 'waiting';
            }

            // Nếu payment_method là banking thì lấy content, nếu không thì gán chuỗi rỗng
            $content = ($request->payment_method === 'banking') ? $request->content : '';

            DB::transaction(function () use ($request, $finalStatus, $course, $content) {

                $payment = Payment::create([
                    'id_user' => $request->id_user,
                    'id_course' => $request->id_course,
                    'payment_method' => $request->payment_method,
                    'content' => $content,
                    'amount' => $request->amount,
                    'status' => $finalStatus,
                ]);

                if ($finalStatus === 'success') {
                    CourseEnrolled::create([
                        'id_user' => $request->id_user,
                        'id_course' => $request->id_course,
                        'title_course' => $course->title,
                        'status' => 'in_progess',
                        'progess' => 0,
                        'expiration_date' => now()->addMonths(1),
                    ]);
                }
            });

            return redirect()->route('admin.payments.index')
                ->with('success', 'Thanh toán đã được thêm thành công');
        } catch (\Exception $e) {
            // Log lỗi nếu cần: Log::error($e);
            return redirect()->back()
                ->with('error', 'Có lỗi xảy ra: ' . $e->getMessage());
        }
    }

    // Hiển thị form chỉnh sửa thanh toán
    public function edit($id)
    {
        $payment = Payment::findOrFail($id);
        $users = User::all(); // Lấy toàn bộ danh sách user
        $courses = Course::all(); // Lấy toàn bộ danh sách khóa học

        return view('admin.themes.payments.editPayment', compact('payment', 'users', 'courses'));
    }


    // Cập nhật thông tin thanh toán
    public function update(Request $request, $id)
    {
        $request->validate([
            'id_user' => 'required|exists:tbl_users,id',
            'id_course' => 'required|exists:tbl_courses,id',
            'payment_method' => 'required|in:vn_pay,banking',
            'amount' => 'required|numeric|min:0',
            'status' => 'required|in:waiting,success,canceled',
        ]);

        try {
            $payment = Payment::findOrFail($id);

            if ($request->status === 'canceled') {
                $finalStatus = 'canceled';
            } else {
                $course = Course::findOrFail($request->id_course);
                $finalStatus = ($request->amount >= $course->price) ? 'success' : 'waiting';
            }

            DB::transaction(function () use ($payment, $request, $finalStatus) {
                $payment->update([
                    'id_user' => $request->id_user,
                    'id_course' => $request->id_course,
                    'payment_method' => $request->payment_method,
                    'amount' => $request->amount,
                    'status' => $finalStatus,
                ]);

                if ($finalStatus === 'success') {
                    $course = Course::findOrFail($request->id_course);

                    CourseEnrolled::create([
                        'id_user' => $request->id_user,
                        'id_course' => $request->id_course,
                        'title_course' => $course->title,
                        'status' => 'in_progess',
                        'progress' => 0,
                        'expiration_date' => now()->addMonths(1),
                    ]);
                }
            });

            return redirect()->route('admin.payments.index')
                ->with('success', 'Thông tin thanh toán đã được cập nhật');
        } catch (\Exception $e) {
            return back()->with('error', 'Có lỗi xảy ra: ' . $e->getMessage());
        }
    }


    // Xóa một thanh toán
    public function destroy($id)
    {
        try {
            $payment = Payment::findOrFail($id);
            $payment->delete();
            return redirect()->route('admin.payments.index')->with('success', 'Thanh toán đã được xóa');
        } catch (\Exception $e) {
            return back()->with('error', 'Không thể xóa thanh toán: ' . $e->getMessage());
        }
    }
}
