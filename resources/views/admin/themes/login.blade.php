@extends('admin.layouts.login')

@section('content')
<div class="limiter">
    <div class="container-login100">
        <div class="wrap-login100">
            <div class="login100-pic js-tilt" data-tilt>
                <img src="{{ asset('assets/login_admin/images/img-01.png') }}" alt="IMG">
            </div>

            <form class="login100-form validate-form" action="{{ route('admin.login') }}" method="POST">
                @csrf
                <span class="login100-form-title">
                    Admin Site
                </span>

                {{-- Hiển thị lỗi --}}
                @if(session('error'))
                <div class="alert alert-danger text-center">
                    {{ session('error') }}
                </div>
                @endif

                @if(session('success'))
                <div class="alert alert-success text-center">
                    {{ session('success') }}
                </div>
                @endif

                <div class="wrap-input100 validate-input" data-validate="Username is required">
                    <input class="input100" type="text" name="username" placeholder="Username" required>
                    <span class="focus-input100"></span>
                    <span class="symbol-input100">
                        <i class="fa fa-user" aria-hidden="true"></i>
                    </span>
                </div>

                <div class="wrap-input100 validate-input" data-validate="Password is required">
                    <input class="input100" type="password" name="password" placeholder="Password" required>
                    <span class="focus-input100"></span>
                    <span class="symbol-input100">
                        <i class="fa fa-lock" aria-hidden="true"></i>
                    </span>
                </div>

                <div class="container-login100-form-btn">
                    <button class="login100-form-btn" type="submit">
                        Login
                    </button>
                </div>

                <div class="text-center p-t-12">
                    <span class="txt1">
                        Forgot
                    </span>
                    <a class="txt2" href="#">
                        Username / Password?
                    </a>
                </div>

                <div class="text-center p-t-136">
                </div>
            </form>
        </div>
    </div>
</div>
@endsection