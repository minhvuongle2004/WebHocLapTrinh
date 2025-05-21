@extends('admin.layouts.admin')

@section('content')
  <div class="container">
    <div class="page-inner">
    <div class="page-header">
      <h3 class="fw-bold mb-3">Quản lý người dùng</h3>
      <ul class="breadcrumbs mb-3">
      <li class="nav-home">
        <a href="{{ route('admin.dashboard') }}">
        <i class="icon-home"></i>
        </a>
      </li>
      <li class="separator">
        <i class="icon-arrow-right"></i>
      </li>
      <li class="nav-item">
        <a href="#">Users</a>
      </li>
      <li class="separator">
        <i class="icon-arrow-right"></i>
      </li>
      <li class="nav-item">
        <a href="#">Thêm mới người dùng</a>
      </li>
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
      <form action="{{ route('admin.users.store') }}" method="POST" enctype="multipart/form-data">
      @csrf
      <div class="col-md-12">
        <div class="card">
        <div class="card-header">
          <div class="card-title">Form thêm mới người dùng</div>
        </div>

        <div class="card-body">
          <div class="row">
          <div class="col-md-6 col-lg-4">

            <!-- Full Name -->
            <div class="form-group">
            <label for="fullname">Họ và tên</label>
            <input type="text" name="fullname" class="form-control" id="fullname"
              placeholder="Điền họ và tên..." required />
            </div>

            <!-- Display Name -->
            <div class="form-group">
            <label for="displayname">Tên hiển thị</label>
            <input type="text" name="displayname" class="form-control" id="displayname"
              placeholder="Điền tên hiển thị..." required />
            </div>

            <!-- Username -->
            <div class="form-group">
            <label for="username">Tên đăng nhập</label>
            <input type="text" name="username" class="form-control" id="username"
              placeholder="Điền tên đăng nhập..." required />
            </div>

            <!-- Email -->
            <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" class="form-control" id="email" placeholder="Điền địa chỉ email..."
              required />
            </div>

            <!-- Password -->
            <div class="form-group">
            <label for="password">Mật khẩu</label>
            <input type="password" name="password" class="form-control" id="password"
              placeholder="Nhập mật khẩu..." required />
            </div>

            <!-- Phone -->
            <div class="form-group">
            <label for="phone">Số điện thoại</label>
            <input type="text" name="phone" class="form-control" id="phone" placeholder="Điền số điện thoại" />
            </div>

            <!-- Avatar -->
            <div class="form-group">
            <label for="avatar">Ảnh đại diện</label>
            <input type="file" name="avatar" class="form-control" id="avatar" />
            </div>
          </div>
          </div>
        </div>
        <div class="card-action">
          <button class="btn btn-success" type="submit">Tạo người dùng</button>
          <button class="btn btn-danger" type="reset">Reset</button>
        </div>
        </div>
      </div>
      </form>
    </div>
    </div>
  </div>
@endsection