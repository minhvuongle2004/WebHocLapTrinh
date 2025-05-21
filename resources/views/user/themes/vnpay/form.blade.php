@extends('user.layouts.home')
@section('content')
    <div class="container mt-5">
        <h2 class="mb-4">Thanh toán qua VNPay</h2>

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('user.vnpay.process') }}" method="POST" id="vnpay_form">
            @csrf
            <input type="hidden" name="course_id" value="{{ $course->id }}">

            <div class="mb-3">
                <label for="amount" class="form-label">Số tiền (VND)</label>
                <input type="number" class="form-control" id="amount" name="amount" value="{{ $course->price }}"
                    readonly>
            </div>

            <div class="mb-3">
                <label for="content" class="form-label">Nội dung thanh toán</label>
                <input type="text" class="form-control" id="content" name="content"
                    value="Thanh toán khóa học: {{ $course->title }}" readonly>
            </div>

            <div class="mb-3">
                <label class="form-label">Phương thức thanh toán</label>
                <div>
                    <input type="radio" id="default" name="bank_code" value="" checked>
                    <label for="default">Chuyển hướng sang VNPay để chọn phương thức</label><br>
                    <input type="radio" id="vnpayqr" name="bank_code" value="VNPAYQR">
                    <label for="vnpayqr">Thanh toán bằng VNPAYQR</label><br>
                    <input type="radio" id="vnbank" name="bank_code" value="VNBANK">
                    <label for="vnbank">Thanh toán qua thẻ ATM/Tài khoản nội địa</label><br>
                    <input type="radio" id="intcard" name="bank_code" value="INTCARD">
                    <label for="intcard">Thanh toán qua thẻ quốc tế</label>
                </div>
                @error('bank_code')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Ngôn ngữ</label>
                <div>
                    <input type="radio" id="vn" name="language" value="vn" checked>
                    <label for="vn">Tiếng Việt</label><br>
                    <input type="radio" id="en" name="language" value="en">
                    <label for="en">Tiếng Anh</label>
                </div>
                @error('language')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Thanh toán</button>
            <a href="{{ route('user.course-payment', $course->id) }}" class="btn btn-secondary">Quay lại</a>
        </form>
    </div>

    <script>
        document.getElementById('vnpay_form').addEventListener('submit', function(event) {
            console.log('Submitting VNPay form to: {{ route('user.vnpay.process') }}');
        });
    </script>
@endsection
