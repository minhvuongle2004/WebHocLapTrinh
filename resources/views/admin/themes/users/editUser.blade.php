@extends('admin.layouts.admin')

@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="page-header">
                <h3 class="fw-bold mb-3">Chỉnh sửa người dùng</h3>
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
                        <a href="#">Chỉnh sửa</a>
                    </li>
                </ul>
            </div>

            @if ($errors->any())
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
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
                <form action="{{ route('admin.users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">Form chỉnh sửa người dùng</div>
                            </div>

                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 col-lg-4">

                                        <!-- Full Name -->
                                        <div class="form-group">
                                            <label for="fullname">Họ và tên</label>
                                            <input type="text" name="fullname" class="form-control" id="fullname"
                                                value="{{ $user->fullname }}" required />
                                        </div>

                                        <!-- Display Name -->
                                        <div class="form-group">
                                            <label for="displayname">Tên hiển thị</label>
                                            <input type="text" name="displayname" class="form-control" id="displayname"
                                                value="{{ $user->displayname }}" required />
                                        </div>

                                        <!-- Username -->
                                        <div class="form-group">
                                            <label for="username">Tên đăng nhập</label>
                                            <input type="text" name="username" class="form-control" id="username"
                                                value="{{ $user->username }}" readonly required />
                                        </div>

                                        <!-- Email -->
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input type="email" name="email" class="form-control"
                                                value="{{ $user->email }}" readonly>
                                        </div>

                                        <!-- Phone -->
                                        <div class="form-group">
                                            <label for="phone">Số điện thoại</label>
                                            <input type="text" name="phone" class="form-control" id="phone"
                                                value="{{ $user->phone ?? '' }}" />
                                        </div>

                                        <!-- Avatar -->
                                        <div class="form-group">
                                            <label for="avatar">Ảnh đại diện</label>
                                            <input type="file" name="avatar" class="form-control" id="avatar" />
                                            @if ($user->avatar)
                                                <img src="{{ asset('storage/' . $user->avatar) }}" alt="Avatar"
                                                    width="100">
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-action">
                                <button class="btn btn-success" type="submit">Lưu thay đổi</button>
                                <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Hủy</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
