@extends('user.layouts.home')
@section('content')
    <div class="container text-center">
        <h2>Thanh toán qua VN Pay</h2>
        <p>Đang chuyển hướng tới cổng thanh toán VNPay cho khóa học: <strong>{{ $course->title }}</strong></p>
        {{-- Hoặc gọi API VNPay ở đây --}}
        <a href="{{ route('user.vnpay.form') }}" class="btn btn-success">Thanh toán ngay</a>
    </div>
@endsection
