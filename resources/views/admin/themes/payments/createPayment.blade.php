@extends('admin.layouts.admin')

@section('content')
  <div class="container">
    <div class="page-inner">
    <div class="page-header">
      <h3 class="fw-bold mb-3">Thêm mới thanh toán</h3>
      <ul class="breadcrumbs mb-3">
      <li class="nav-home">
        <a href="{{ route('admin.dashboard') }}"><i class="icon-home"></i></a>
      </li>
      <li class="separator"><i class="icon-arrow-right"></i></li>
      <li class="nav-item"><a href="#">Payments</a></li>
      <li class="separator"><i class="icon-arrow-right"></i></li>
      <li class="nav-item"><a href="#">Thêm mới</a></li>
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
      <form action="{{ route('admin.payments.store') }}" method="post">
      @csrf
      <div class="col-md-12">
        <div class="card">
        <div class="card-header">
          <div class="card-title">Form thêm mới thanh toán</div>
        </div>

        <div class="card-body">
          <div class="row">
          <div class="col-md-6 col-lg-4">

            <div class="form-group">
            <label for="id_user">Người dùng</label>
            <select name="id_user" class="form-select select2" id="id_user" required>
              <option value="" disabled selected>Chọn người dùng...</option>
              @foreach ($users as $user)
          <option value="{{ $user->id }}">{{ $user->fullname }} ({{ $user->email }})</option>
        @endforeach
            </select>
            </div>

            <div class="form-group">
            <label for="id_course">Khóa học</label>
            <select name="id_course" class="form-select selectpicker" id="id_course" data-live-search="true"
              title="Chọn khóa học..." required>
              <option value="" disabled selected>Chọn khoá học...</option>
              @foreach ($courses as $course)
          <option value="{{ $course->id }}">
          {{ $course->title }} - {{ number_format($course->price, 0) }} VNĐ
          </option>
        @endforeach
            </select>
            </div>

            <div class="form-group">
            <label for="payment_method">Phương thức thanh toán</label>
            <select name="payment_method" class="form-select" id="payment_method">
              <option value="vn_pay">VN Pay</option>
              <option value="banking">Banking</option>
            </select>
            </div>

            <div class="form-group" id="banking_content_group" style="display: none;">
            <label for="content">Nội dung chuyển khoản</label>
            <input type="text" name="content" class="form-control" id="content"
              placeholder="Nhập nội dung chuyển khoản" />
            </div>


            <div class="form-group">
            <label for="amount">Số tiền</label>
            <input type="number" step="0.01" name="amount" class="form-control" id="amount"
              placeholder="Nhập số tiền" required />
            </div>

            <div class="form-group">
            <label for="status">Trạng thái</label>
            <select name="status" class="form-select" id="status">
              <option value="waiting">Đang chờ</option>
              <option value="success">Thành công</option>
              <option value="canceled">Đã hủy</option>
            </select>
            </div>
          </div>
          </div>
        </div>
        <div class="card-action">
          <button class="btn btn-success" type="submit">Thêm thanh toán</button>
          <button class="btn btn-danger" type="reset">Reset</button>
        </div>
        </div>
      </div>
      </form>
    </div>
    </div>
  </div>

  @section('scripts')
    <!-- Select2 -->
    <script>
    $(document).ready(function () {

    $('#payment_method').change(function () {
      if ($(this).val() === 'banking') {
      $('#banking_content_group').show();
      $('#amount').val(0).prop('readonly', true);
      } else {
      $('#banking_content_group').hide();
      $('#content').val('');
      $('#amount').prop('readonly', false);
      }
    });

    // Kiểm tra giá trị mặc định khi load trang (trong trường hợp chỉnh sửa)
    if ($('#payment_method').val() === 'banking') {
      $('#banking_content_group').show();
      $('#amount').val(0).prop('readonly', true);
    }
    });
    </script>
  @endsection

@endsection