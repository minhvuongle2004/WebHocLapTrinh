<?php

namespace App\Http\Controllers\Admin;

use App\Models\Income;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        $currentMonth = now()->month;
        $currentYear = now()->year;
        $monthYearFormatted = now()->format('m/Y');

        // Đếm số lượng khách truy cập (có thể bạn cần cập nhật logic này tùy thuộc vào cách bạn theo dõi người truy cập)
        // Vì không có bảng visitors cụ thể, tôi giả định sử dụng dữ liệu từ bảng incomes
        $visitors = Income::where('type', 'day')
            ->whereMonth('time', $currentMonth)
            ->whereYear('time', $currentYear)
            ->sum('total_buyer');

        // Đếm tổng số người dùng đăng ký
        $subscribers = User::count();

        // Tính tổng doanh thu tháng hiện tại từ các thanh toán thành công
        $sales = Payment::whereMonth('created_at', $currentMonth)
            ->whereYear('created_at', $currentYear)
            ->where('status', 'success') // Theo migration, status là 'success' khi thanh toán thành công
            ->sum('amount');

        // Đếm số lượng giao dịch thành công trong tháng
        $orders = Payment::whereMonth('created_at', $currentMonth)
            ->whereYear('created_at', $currentYear)
            ->where('status', 'success')
            ->count();

        $latestUsers = User::latest('created_at')
            ->take(6)
            ->get(['id', 'fullname', 'displayname', 'email', 'avatar', 'created_at']);

        return view('admin.themes.dashboard', compact('visitors', 'subscribers', 'sales', 'orders', 'monthYearFormatted', 'latestUsers'));
    }

    public function login()
    {
        return view('admin.themes.login');
    }
}