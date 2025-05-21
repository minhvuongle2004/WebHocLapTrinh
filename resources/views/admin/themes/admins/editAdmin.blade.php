@extends('admin.layouts.admin')

@section('content')
<div class="container">
  <div class="page-inner">
    <div class="page-header">
      <h3 class="fw-bold mb-3">Chỉnh sửa Admin</h3>
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
          <a href="#">Admins</a>
        </li>
        <li class="separator">
          <i class="icon-arrow-right"></i>
        </li>
        <li class="nav-item">
          <a href="#">Chỉnh sửa</a>
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
      <form action="{{ route('admin.admins.update', $admin->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <div class="card-title">Form chỉnh sửa Admin</div>
            </div>

            <div class="card-body">
              <div class="row">
                <div class="col-md-6 col-lg-4">

                  <!-- Username -->
                  <div class="form-group">
                    <label for="username">Tên đăng nhập</label>
                    <input type="text" name="username" class="form-control" id="username" value="{{ $admin->username }}" required />
                  </div>

                  <!-- Password -->
                  <div class="form-group">
                    <label for="password">Mật khẩu (để trống nếu không đổi)</label>
                    <input type="password" name="password" class="form-control" id="password" placeholder="Nhập mật khẩu mới nếu muốn thay đổi..." />
                  </div>
                </div>
              </div>
            </div>
            <div class="card-action">
              <button class="btn btn-success" type="submit">Lưu thay đổi</button>
              <a href="{{ route('admin.admins.index') }}" class="btn btn-secondary">Hủy</a>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection