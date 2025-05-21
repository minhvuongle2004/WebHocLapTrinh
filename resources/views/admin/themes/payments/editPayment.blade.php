@extends('admin.layouts.admin')

@section('content')
  <div class="container">
    <div class="page-inner">
    <div class="page-header">
      <h3 class="fw-bold mb-3">Chỉnh sửa thanh toán</h3>
      <ul class="breadcrumbs mb-3">
      <li class="nav-home">
        <a href="{{ route('admin.dashboard') }}"><i class="icon-home"></i></a>
      </li>
      <li class="separator"><i class="icon-arrow-right"></i></li>
      <li class="nav-item"><a href="#">Payments</a></li>
      <li class="separator"><i class="icon-arrow-right"></i></li>
      <li class="nav-item"><a href="#">Chỉnh sửa</a></li>
      </ul>
    </div>

    @if ($errors->any())
    <script>
      document.addEventListener('DOMContentLoaded', function () {
      let errorMessages = "";
      @foreach ($errors->all() as $error)
      errorMessages += "{{ $error }}\n";
    @endforeach
      Swal.fire({
      icon: 'error',
      title: 'Lỗi nhập liệu!',
      text: errorMessages,
      confirmButtonText: 'OK'
      });
      });
    </script>
  @endif

    <div class="row">
      <form action="{{ route('admin.payments.update', $payment->id) }}" method="post">
      @csrf
      @method('PUT')
      <div class="col-md-12">
        <div class="card">
        <div class="card-header">
          <div class="card-title">Form chỉnh sửa thanh toán</div>
        </div>

        <div class="card-body">
          <div class="row">
          <div class="col-md-6 col-lg-4">

            <!-- Hiển thị tên người dùng, không cho chỉnh sửa -->
            <div class="form-group">
            <label for="user">Người dùng</label>
            <input type="text" class="form-control" id="user" value="{{ $payment->user->fullname }}" readonly />
            <input type="hidden" name="id_user" value="{{ $payment->id_user }}">
            </div>

            <!-- Khóa học: select hiển thị Tên + Giá, cho phép thay đổi -->
            <div class="form-group">
            <label for="id_course">Khóa học</label>
            <select name="id_course" class="form-select" id="id_course" required>
              @foreach($courses as $course)
          <option value="{{ $course->id }}" {{ $payment->id_course == $course->id ? 'selected' : '' }}>
          {{ $course->title }} - {{ number_format($course->price, 0) }} VNĐ
          </option>
        @endforeach
            </select>
            </div>

            <!-- Phương thức thanh toán: không cho đổi, chỉ hiển thị readonly -->
            <div class="form-group">
            <label for="payment_method_display">Phương thức thanh toán</label>
            <input type="text" class="form-control" id="payment_method_display"
              value="{{ $payment->payment_method === 'banking' ? 'Banking' : 'VN Pay' }}" readonly />
            <!-- Hidden input để giữ lại giá trị thật -->
            <input type="hidden" name="payment_method" value="{{ $payment->payment_method }}">
            </div>

            <!-- Nội dung chuyển khoản (chỉ hiển thị nếu payment_method = banking) -->
            <div class="form-group" id="banking_content_group" style="display: none;">
            <label for="content">Nội dung chuyển khoản</label>
            <input type="text" class="form-control" name="content" id="content"
              value="{{ $payment->content ?? '' }}" placeholder="Nhập nội dung chuyển khoản" />
            </div>

            <!-- Số tiền -->
            <div class="form-group">
            <label for="amount">Số tiền</label>
            <input type="number" step="0.01" name="amount" class="form-control" id="amount"
              value="{{ $payment->amount }}" required />
            </div>

            <!-- Trạng thái -->
            <div class="form-group">
            <label for="status">Trạng thái</label>
            <select name="status" class="form-select" id="status">
              <option value="waiting" {{ $payment->status == 'waiting' ? 'selected' : '' }}>Đang chờ</option>
              <option value="success" {{ $payment->status == 'success' ? 'selected' : '' }}>Thành công</option>
              <option value="canceled" {{ $payment->status == 'canceled' ? 'selected' : '' }}>Đã hủy</option>
            </select>
            </div>

          </div>
          </div>
        </div>

        <div class="card-action">
          <button class="btn btn-primary" type="submit">Cập nhật</button>
          <button class="btn btn-danger" type="reset">Reset</button>
        </div>

        </div>
      </div>
      </form>
    </div>
    </div>
  </div>
@endsection

@section('scripts')
  @parent
  <script>
    document.addEventListener('DOMContentLoaded', function () {
    // Lấy giá trị thật của payment_method từ hidden input
    const paymentMethod = document.querySelector('input[name="payment_method"]').value;
    const bankingContentGroup = document.getElementById('banking_content_group');

    // Nếu payment_method là banking => hiển thị nội dung chuyển khoản
    if (paymentMethod === 'banking') {
      bankingContentGroup.style.display = 'block';
    } else {
      bankingContentGroup.style.display = 'none';
    }
    });
  </script>
@endsection