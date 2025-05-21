@extends('user.layouts.home')
@section('content')
    <div class="container text-center">
        <h2>Chuyển khoản ngân hàng</h2>
        <p>Vui lòng quét mã QR bên dưới để thanh toán khóa học: <strong>{{ $course->title }}</strong></p>
        <img src="{{ $qrUrl }}" alt="QR VietQR" style="max-width: 400px;">
        <p><strong>Số tiền:</strong> {{ number_format($course->price) }}₫</p>
        <p><strong>Nội dung:</strong> {{ $content }}</p>
    </div>

    <div class="text-center mt-4" style="margin-bottom: 16px;">
        <form action="{{ route('user.banking.confirm') }}" method="POST">
            @csrf
            <input type="hidden" name="course_id" value="{{ $course->id }}">
            <input type="hidden" name="content" value="{{ $content }}">
            <input type="hidden" name="amount" value="{{ $course->price }}">
            <button type="submit" class="btn btn-success">Xác nhận đã chuyển khoản</button>
        </form>
    </div>
@endsection
