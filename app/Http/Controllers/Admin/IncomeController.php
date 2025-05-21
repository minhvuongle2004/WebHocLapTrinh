<?php

namespace App\Http\Controllers\Admin;

use App\Models\Course;
use App\Models\Income;
use App\Models\Payment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IncomeController extends Controller
{
    // Hiển thị danh sách tất cả doanh thu
    public function index()
    {
        $incomes = Income::all();
        return view('admin.themes.incomes.tableIncome', compact('incomes'));
    }

    // Hiển thị chi tiết một doanh thu
    public function show($id)
    {
        $income = Income::findOrFail($id);
        return view('admin.themes.incomes.incomeDetail', compact('income'));
    }

    // Hiển thị form tạo doanh thu mới
    public function create()
    {
        return view('admin.themes.incomes.createIncome');
    }

    // Lưu doanh thu mới vào database (BỎ KIỂM TRA TỒN TẠI)
    public function store(Request $request)
    {
        $request->validate([
            'total_buyer' => 'required|integer|min:0',
            'total_amount' => 'required|numeric|min:0',
            'time' => 'required|date',
            'type' => 'required|in:day,month'
        ]);

        // Chuyển đổi định dạng lưu vào database thành d-m-Y
        $time = Carbon::parse($request->time)->format('d-m-Y');

        // Kiểm tra xem bản ghi theo ngày hoặc tháng đã tồn tại chưa
        $existingIncome = Income::where('time', $time)
            ->where('type', $request->type)
            ->first();

        if ($existingIncome) {
            return redirect()->route('admin.incomes.create')->with([
                'warning' => 'Bản ghi đã tồn tại. Bạn có muốn ghi đè không?',
                'id' => $existingIncome->id
            ]);
        }

        // Nếu không có bản ghi tồn tại, tạo mới
        $income = Income::create([
            'total_buyer' => $request->total_buyer,
            'total_amount' => $request->total_amount,
            'time' => $time, // Lưu theo d-m-Y
            'type' => $request->type
        ]);

        return redirect()->route('admin.incomes.index')->with('success', 'Doanh thu đã được thêm thành công!');
    }

    // Hiển thị form chỉnh sửa doanh thu
    public function edit($id)
    {
        $income = Income::findOrFail($id);
        return view('admin.themes.incomes.editIncome', compact('income'));
    }

    // Cập nhật thông tin doanh thu
    public function update(Request $request, $id)
    {
        // Kiểm tra dữ liệu đầu vào
        $request->validate([
            'total_buyer' => 'required|integer|min:0',
            'total_amount' => 'required|numeric|min:0',
            'time' => 'required|date', // Đảm bảo đầu vào là ngày hợp lệ
        ]);

        try {
            // Kiểm tra xem bản ghi có tồn tại không
            $income = Income::findOrFail($id);

            // Chuyển đổi định dạng thời gian sang d-m-Y
            $time = Carbon::parse($request->time)->format('d-m-Y');

            // Cập nhật dữ liệu
            $income->update([
                'total_buyer' => $request->total_buyer,
                'total_amount' => $request->total_amount,
                'time' => $time, // Lưu theo d-m-Y
            ]);

            // Điều hướng về danh sách doanh thu kèm thông báo thành công
            return redirect()->route('admin.incomes.index')->with('success', 'Thông tin doanh thu đã được cập nhật!');
        } catch (\Exception $e) {
            // Điều hướng kèm thông báo lỗi nếu có vấn đề
            return redirect()->route('admin.incomes.index')->with('error', 'Lỗi khi cập nhật doanh thu: ' . $e->getMessage());
        }
    }

    // Xóa một doanh thu
    public function destroy($id)
    {
        $income = Income::findOrFail($id);
        $income->delete();
        return redirect()->route('admin.incomes.index')->with('success', 'Doanh thu đã được xóa');
    }

    // Lấy doanh thu theo ngày (KHÔNG KIỂM TRA TỒN TẠI)
    public function autoFillDaily()
    {
        $today = Carbon::today();

        $payments = Payment::whereDate('created_at', $today)
            ->where('status', 'success')
            ->get();

        $total_buyer = $payments->count();
        $total_amount = 0;

        foreach ($payments as $payment) {
            $total_amount += optional(Course::find($payment->id_course))->price ?? 0;
        }

        return response()->json([
            'total_buyer' => $total_buyer,
            'total_amount' => $total_amount,
            'time' => $today->format('Y-m-d'), // Giữ YYYY-MM-DD để form hoạt động đúng
            'type' => 'day',
        ]);
    }

    public function autoFillMonthly()
    {
        $startOfMonth = Carbon::now()->startOfMonth()->startOfDay();
        $endOfToday = Carbon::now()->endOfDay();

        $payments = Payment::whereBetween('created_at', [$startOfMonth, $endOfToday])
            ->where('status', 'success')
            ->get();

        $total_buyer = $payments->count();
        $total_amount = 0;

        foreach ($payments as $payment) {
            $total_amount += optional(Course::find($payment->id_course))->price ?? 0;
        }

        return response()->json([
            'total_buyer' => $total_buyer,
            'total_amount' => $total_amount,
            'time' => $startOfMonth->format('Y-m-d'), // Giữ YYYY-MM-DD để form hoạt động đúng
            'type' => 'month',
        ]);
    }
}
