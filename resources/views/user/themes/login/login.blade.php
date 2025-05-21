@extends('user.layouts.home')
@section('content')
    <style>
        /* Container cho checkbox */
        .custom-checkbox {
            display: block;
            position: relative;
            cursor: pointer;
            width: 24px;
            height: 24px;
        }

        /* Ẩn checkbox mặc định */
        .custom-checkbox input {
            position: absolute;
            opacity: 0;
            cursor: pointer;
            height: 0;
            width: 0;
        }

        /* Tạo hình vuông custom có bo góc 20% */
        .checkmark {
            position: absolute;
            top: 0;
            left: 0;
            height: 24px;
            width: 24px;
            background-color: white;
            border: 1px solid #ccc;
            border-radius: 20%;
            transition: all 0.2s ease;
        }

        /* Khi hover vào checkbox */
        .custom-checkbox:hover input~.checkmark {
            border-color: #888;
        }

        /* Khi checkbox được chọn */
        .custom-checkbox input:checked~.checkmark {
            background-color: #2196F3;
            border-color: #2196F3;
        }

        /* Tạo dấu tích */
        .checkmark:after {
            content: "";
            position: absolute;
            display: none;
        }

        /* Hiển thị dấu tích khi được chọn */
        .custom-checkbox input:checked~.checkmark:after {
            display: block;
        }

        /* Style cho dấu tích */
        .custom-checkbox .checkmark:after {
            left: 9px;
            top: 5px;
            width: 6px;
            height: 12px;
            border: solid white;
            border-width: 0 2px 2px 0;
            transform: rotate(45deg);
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Thành công!',
                text: '{{ session('success') }}',
                confirmButtonText: 'OK'
            });
        </script>
    @endif

    @if (session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Lỗi!',
                text: '{{ session('error') }}',
                confirmButtonText: 'OK'
            });
        </script>
    @endif

    <div id="wrapper" class="wrapper">
        <div class="container">
            <!-- Thêm login-container bao trọn mọi nội dung bên trong -->
            <div class="login-container">
                <div class="pages-template">
                    <section class="page-content">
                        <div class="entry-content">
                            <div class="masterstudy__login-page">
                                <div class="masterstudy__login-page-form">
                                    <div class="masterstudy-authorization masterstudy-authorization_login">
                                        <div class="masterstudy-authorization__wrapper">
                                            {{-- Form Sign In --}}
                                            <div id="masterstudy-authorization-form-login"
                                                class="masterstudy-authorization__form">
                                                <div class="masterstudy-authorization__header">
                                                    <span class="masterstudy-authorization__header-title">
                                                        Sign In </span>
                                                </div>
                                                <form action="{{ route('user.login') }}" method="POST">
                                                    @csrf
                                                    <div class="masterstudy-authorization__form-wrapper">
                                                        <div class="masterstudy-authorization__form-field">
                                                            <input type="text" name="username"
                                                                class="masterstudy-authorization__form-input @error('username') is-invalid @enderror"
                                                                placeholder="Enter email or username"
                                                                value="{{ old('username') }}">
                                                            @error('username')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                        <div class="masterstudy-authorization__form-field">
                                                            <input type="password" name="password"
                                                                class="masterstudy-authorization__form-input masterstudy-authorization__form-input_pass @error('password') is-invalid @enderror"
                                                                placeholder="Enter password">
                                                            <span class="masterstudy-authorization__form-show-pass"></span>
                                                            @error('password')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="masterstudy-authorization__actions">
                                                        <div class="masterstudy-authorization__actions-remember">
                                                            <div style="display: flex; align-items: center; gap: 10px;">
                                                                <label class="custom-checkbox">
                                                                    <input type="checkbox">
                                                                    <span class="checkmark"></span>
                                                                </label>
                                                                <span>Remember me</span>
                                                            </div>
                                                        </div>
                                                        <button type="submit"
                                                            class="masterstudy-button masterstudy-button_style-primary masterstudy-button_size-sm">
                                                            <span class="masterstudy-button__title">Sign In</span>
                                                        </button>
                                                    </div>
                                                </form>
                                                <div class="masterstudy-authorization__switch">
                                                    <div class="masterstudy-authorization__switch-wrapper">
                                                        <div class="masterstudy-authorization__switch-account">
                                                            <span class="masterstudy-authorization__switch-account-title">
                                                                No account? </span>
                                                            <a href="#" id="masterstudy-authorization-sign-up"
                                                                class="masterstudy-authorization__switch-account-link">
                                                                Sign Up </a>
                                                        </div>
                                                        {{-- <span class="masterstudy-authorization__switch-lost-pass">
                                                            Lost Password? </span> --}}
                                                    </div>
                                                </div>
                                            </div>
                                            {{-- End Form Sign In --}}
                                            {{-- Form Sign Up --}}
                                            <div id="masterstudy-authorization-form-register"
                                                class="masterstudy-authorization__form">
                                                <div class="masterstudy-authorization__header">
                                                    <span class="masterstudy-authorization__header-title">
                                                        Sign Up </span>
                                                </div>
                                                <form action="{{ route('user.register') }}" method="POST" id="signup-form">
                                                    @csrf
                                                    <div class="masterstudy-authorization__form-wrapper">
                                                        <div class="masterstudy-authorization__form-field">
                                                            <input type="text" name="fullname"
                                                                class="masterstudy-authorization__form-input @error('fullname') is-invalid @enderror"
                                                                placeholder="Enter your full name"
                                                                value="{{ old('fullname') }}">
                                                            @error('fullname')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                        <div class="masterstudy-authorization__form-field">
                                                            <input type="text" name="displayname"
                                                                class="masterstudy-authorization__form-input @error('displayname') is-invalid @enderror"
                                                                placeholder="Enter display name"
                                                                value="{{ old('displayname') }}">
                                                            @error('displayname')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                        <div class="masterstudy-authorization__form-field">
                                                            <input type="email" name="email"
                                                                class="masterstudy-authorization__form-input @error('email') is-invalid @enderror"
                                                                placeholder="Enter your email" value="{{ old('email') }}">
                                                            @error('email')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                        <div class="masterstudy-authorization__form-field">
                                                            <input type="text" name="username"
                                                                class="masterstudy-authorization__form-input @error('username') is-invalid @enderror"
                                                                placeholder="Enter username" value="{{ old('username') }}">
                                                            @error('username')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                        <div class="masterstudy-authorization__form-field">
                                                            <input type="password" name="password" id="password"
                                                                class="masterstudy-authorization__form-input masterstudy-authorization__form-input_pass @error('password') is-invalid @enderror"
                                                                placeholder="Enter password">
                                                            <span class="masterstudy-authorization__form-show-pass"></span>
                                                            <span class="masterstudy-authorization__form-explain-pass">
                                                                Mật khẩu phải có ít nhất 6 ký tự và không dài quá 50 ký tự
                                                            </span>
                                                            @error('password')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                        <div class="masterstudy-authorization__form-field">
                                                            <input type="password" name="password_confirmation"
                                                                id="password_confirmation"
                                                                class="masterstudy-authorization__form-input masterstudy-authorization__form-input_pass"
                                                                placeholder="Repeat password">
                                                            <span class="masterstudy-authorization__form-show-pass"></span>
                                                            <span class="password-confirm-error invalid-feedback"
                                                                style="display: none;">
                                                                <strong>Mật khẩu nhập lại không khớp</strong>
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div class="masterstudy-authorization__actions">
                                                        <div class="masterstudy-authorization__actions-remember">
                                                            {{-- <div style="display: flex; align-items: center; gap: 10px;">
                                                                <label class="custom-checkbox">
                                                                    <input type="checkbox">
                                                                    <span class="checkmark"></span>
                                                                </label>
                                                                <span>Remember me</span>
                                                            </div> --}}
                                                        </div>
                                                        <button type="submit" id="signup-button"
                                                            class="masterstudy-button masterstudy-button_style-primary masterstudy-button_size-sm">
                                                            <span class="masterstudy-button__title">Sign Up</span>
                                                        </button>
                                                    </div>
                                                </form>
                                                <div class="masterstudy-authorization__switch">
                                                    <div class="masterstudy-authorization__switch-wrapper">
                                                        <div class="masterstudy-authorization__switch-account">
                                                            <span class="masterstudy-authorization__switch-account-title">
                                                                Have account? </span>
                                                            <a href="#" id="masterstudy-authorization-sign-in"
                                                                class="masterstudy-authorization__switch-account-link">
                                                                Sign In </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- Form Restore password --}}
                                        <div class="masterstudy-authorization__restore">
                                            <div class="masterstudy-authorization__restore-header">
                                                <span class="masterstudy-authorization__restore-header-back"></span>
                                                <span class="masterstudy-authorization__restore-header-title">
                                                    Restore password </span>
                                            </div>
                                            <div id="masterstudy-authorization-form-restore"
                                                class="masterstudy-authorization__form">
                                                <div class="masterstudy-authorization__form-wrapper">
                                                    <div class="masterstudy-authorization__form-field">
                                                        <input type="text" name="restore_user_login"
                                                            class="masterstudy-authorization__form-input"
                                                            placeholder="Enter your email">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="masterstudy-authorization__actions">
                                                <a href="#"
                                                    class="masterstudy-button masterstudy-button_style-primary masterstudy-button_size-sm"
                                                    data-id=masterstudy-authorization-restore-button>
                                                    <span class="masterstudy-button__title">Send reset link</span>
                                                </a>
                                            </div>
                                        </div>
                                        {{-- End Form Restore password --}}
                                        <div id="masterstudy-authorization-restore-pass"
                                            class="masterstudy-authorization__send-mail">
                                            <div class="masterstudy-authorization__send-mail-icon-wrapper">
                                                <span class="masterstudy-authorization__send-mail-icon"></span>
                                            </div>
                                            <span class="masterstudy-authorization__send-mail-content">
                                                <span class="masterstudy-authorization__send-mail-content-title">
                                                    Password reset link sent </span>
                                                <span class="masterstudy-authorization__send-mail-content-subtitle">
                                                    to your email </span>
                                            </span>
                                        </div>

                                        <div id="masterstudy-authorization-confirm-email"
                                            class="masterstudy-authorization__send-mail">
                                            <div class="masterstudy-authorization__send-mail-icon-wrapper">
                                                <span class="masterstudy-authorization__send-mail-icon"></span>
                                            </div>
                                            <span class="masterstudy-authorization__send-mail-title">
                                                Confirmation link sent </span>
                                            <span class="masterstudy-authorization__send-mail-instructions">
                                                Please follow the instructions sent to your email address </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const signInForm = document.getElementById("masterstudy-authorization-form-login");
            const signUpForm = document.getElementById("masterstudy-authorization-form-register");
            const signUpLink = document.getElementById("masterstudy-authorization-sign-up");
            const signInLink = document.getElementById("masterstudy-authorization-sign-in");
            const loginContainer = document.querySelector(".login-container");
            const signupForm = document.getElementById("signup-form");
            const signupButton = document.getElementById("signup-button");
            const passwordInput = document.getElementById("password");
            const passwordConfirmInput = document.getElementById("password_confirmation");
            const passwordConfirmError = document.querySelector(".password-confirm-error");

            // Kiểm tra nếu có lỗi validation trong form đăng ký thì hiển thị form đăng ký
            const hasRegisterErrors = {{ $errors->any() && old('email') ? 'true' : 'false' }};

            if (hasRegisterErrors) {
                // Hiển thị form đăng ký nếu có lỗi
                signInForm.style.opacity = "0";
                signInForm.style.position = "absolute";
                signInForm.style.pointerEvents = "none";
                signInForm.style.display = "none";

                signUpForm.style.display = "block";
                signUpForm.style.position = "relative";
                signUpForm.style.opacity = "1";
                signUpForm.style.transform = "translateY(0)";
                signUpForm.style.pointerEvents = "auto";

                updateContainerHeight(signUpForm);
            } else {
                // Ẩn form đăng ký ban đầu nhưng không dùng display: none để tránh lỗi
                signUpForm.style.opacity = "0";
                signUpForm.style.position = "absolute";
                signUpForm.style.pointerEvents = "none";
                signUpForm.style.display = "none";

                updateContainerHeight(signInForm);
            }

            // Chuyển đổi giữa form đăng nhập và đăng ký
            signUpLink.addEventListener("click", function(event) {
                event.preventDefault();
                toggleForms(signInForm, signUpForm);
            });

            signInLink.addEventListener("click", function(event) {
                event.preventDefault();
                toggleForms(signUpForm, signInForm);
            });

            // Xử lý việc submit form đăng ký
            if (signupForm) {
                signupForm.addEventListener("submit", function(event) {
                    event.preventDefault(); // Ngăn form submit mặc định

                    let isValid = true;

                    // Kiểm tra mật khẩu và mật khẩu xác nhận
                    if (passwordInput.value !== passwordConfirmInput.value) {
                        passwordConfirmError.style.display = "block";
                        isValid = false;
                    } else {
                        passwordConfirmError.style.display = "none";
                    }

                    // Xóa tất cả thông báo lỗi cũ trước khi kiểm tra mới
                    const invalidFeedbacks = signupForm.querySelectorAll('.invalid-feedback');
                    invalidFeedbacks.forEach(element => {
                        if (!element.classList.contains('password-confirm-error')) {
                            element.style.display = 'none';
                        }
                    });

                    const invalidInputs = signupForm.querySelectorAll('.is-invalid');
                    invalidInputs.forEach(element => {
                        element.classList.remove('is-invalid');
                    });

                    // Kiểm tra các trường bắt buộc
                    const requiredFields = ['fullname', 'displayname', 'username', 'email', 'password',
                        'password_confirmation'
                    ];
                    requiredFields.forEach(field => {
                        const input = signupForm.querySelector(`[name="${field}"]`);
                        if (input && !input.value.trim()) {
                            input.classList.add('is-invalid');
                            const errorElement = input.parentElement.querySelector(
                                '.invalid-feedback');
                            if (errorElement) {
                                errorElement.innerHTML =
                                    `<strong>Vui lòng nhập ${getFieldLabel(field)}.</strong>`;
                                errorElement.style.display = 'block';
                            }
                            isValid = false;
                        }
                    });

                    if (!isValid) {
                        updateContainerHeight(signUpForm);
                        return false;
                    }

                    // Sử dụng Fetch API để gửi form
                    fetch(signupForm.action, {
                            method: 'POST',
                            body: new FormData(signupForm),
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            }
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                // ✅ Hiển thị SweetAlert rồi mới redirect
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Thành công!',
                                    text: 'Đăng ký thành công! Vui lòng đăng nhập.',
                                    confirmButtonText: 'OK'
                                }).then(() => {
                                    window.location.href = data.redirect;
                                });
                            } else if (data.errors) {
                                // Hiển thị lỗi validation
                                let errorMessage = '';

                                // Kiểm tra nếu errors là object chứa các lỗi validation
                                if (typeof data.errors === 'object') {
                                    // Tạo danh sách lỗi từ object
                                    for (const field in data.errors) {
                                        errorMessage += `- ${data.errors[field].join('<br>- ')}<br>`;
                                    }
                                } else if (Array.isArray(data.errors)) {
                                    // Nếu là mảng thì nối các lỗi lại
                                    errorMessage = data.errors.join('<br>');
                                } else {
                                    // Nếu là string
                                    errorMessage = data.errors;
                                }

                                Swal.fire({
                                    icon: 'error',
                                    title: 'Thất bại!',
                                    html: errorMessage, // Sử dụng html thay vì text để hiển thị định dạng
                                    confirmButtonText: 'OK'
                                });

                                // Có thể hiển thị lỗi vào các field tương ứng nếu cần
                                if (typeof data.errors === 'object') {
                                    // Reset các lỗi cũ trước khi hiển thị lỗi mới
                                    document.querySelectorAll('.is-invalid').forEach(el => {
                                        el.classList.remove('is-invalid');
                                    });
                                    document.querySelectorAll('.invalid-feedback').forEach(el => {
                                        el.remove();
                                    });

                                    // Hiển thị lỗi vào các field tương ứng
                                    for (const field in data.errors) {
                                        const inputElement = document.querySelector(
                                            `[name="${field}"]`);
                                        if (inputElement) {
                                            inputElement.classList.add('is-invalid');

                                            // Tạo element hiển thị lỗi
                                            const feedbackElement = document.createElement('div');
                                            feedbackElement.className = 'invalid-feedback';
                                            feedbackElement.textContent = data.errors[field][0];

                                            // Thêm sau input
                                            inputElement.parentNode.appendChild(feedbackElement);
                                        }
                                    }
                                }

                                updateContainerHeight(signUpForm);
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            Swal.fire({
                                icon: 'error',
                                title: 'Lỗi!',
                                text: 'Đã xảy ra lỗi, vui lòng thử lại sau.',
                                confirmButtonText: 'OK'
                            });
                        });

                    return false;
                });
            }

            function getFieldLabel(field) {
                const labels = {
                    'fullname': 'họ tên đầy đủ',
                    'displayname': 'tên hiển thị',
                    'username': 'tên đăng nhập',
                    'email': 'địa chỉ email',
                    'password': 'mật khẩu',
                    'password_confirmation': 'xác nhận mật khẩu'
                };
                return labels[field] || field;
            }
            // Kiểm tra mật khẩu xác nhận khi gõ
            if (passwordConfirmInput) {
                passwordConfirmInput.addEventListener('input', function() {
                    if (passwordInput.value !== passwordConfirmInput.value) {
                        passwordConfirmError.style.display = "block";
                    } else {
                        passwordConfirmError.style.display = "none";
                    }
                });
            }

            function toggleForms(hideForm, showForm) {
                hideForm.style.opacity = "0";
                hideForm.style.transform = "translateY(-20px)";
                hideForm.style.pointerEvents = "none";

                setTimeout(() => {
                    hideForm.style.position = "absolute";
                    hideForm.style.display = "none";

                    showForm.style.display = "block";
                    showForm.style.position = "relative";
                    showForm.style.opacity = "1";
                    showForm.style.transform = "translateY(0)";
                    showForm.style.pointerEvents = "auto";

                    updateContainerHeight(showForm);

                    // Hiển thị lại nút và link bị ẩn
                    const hiddenElements = showForm.querySelectorAll("a, button");
                    hiddenElements.forEach(el => {
                        el.style.display = "inline-block";
                    });

                }, 300);
            }

            function updateContainerHeight(activeForm) {
                setTimeout(() => {
                    const formHeight = activeForm.offsetHeight;
                    loginContainer.style.height = (formHeight + 100) +
                        "px"; // Cộng thêm khoảng trống để tránh cắt mất nút
                }, 200);
            }
        });
    </script>
    <style>
        .login-container {
            max-width: 500px;
            margin: 50px auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 15px;
            background-color: #fff;
            box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.2);
            transition: height 0.3s ease-in-out, width 0.3s ease-in-out, padding 0.3s ease-in-out;
            overflow: visible;
            /* Đảm bảo nội dung không bị cắt */
            min-height: 400px;
            width: calc(100% - 160px);
            max-width: 600px;
        }

        .masterstudy-authorization__form {
            transition: opacity 0.3s ease-in-out, transform 0.3s ease-in-out;
            position: relative;
        }

        .masterstudy-button {
            display: flex !important;
            justify-content: center !important;
            align-items: center !important;
            text-align: center !important;
            height: 40px !important;
            /* Đảm bảo chiều cao */
            line-height: 40px !important;
            /* Giữ chữ căn giữa */
        }

        .masterstudy-button .masterstudy-button__title {
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            width: 100% !important;
            height: 100% !important;
            line-height: normal !important;
        }

        .masterstudy-button span {
            display: inline-block;
            vertical-align: middle;
        }

        /* Fix lỗi nút bị ẩn */
        .masterstudy-authorization__actions a {
            display: inline-block !important;
        }

        /* Thêm các style cho feedback khi validate */
        .invalid-feedback {
            display: block;
            color: #e3342f;
            font-size: 0.875rem;
            margin-top: 0.25rem;
        }

        .is-invalid {
            border-color: #e3342f !important;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Tìm tất cả các nút show/hide password
            const showPasswordButtons = document.querySelectorAll('.masterstudy-authorization__form-show-pass');

            // Thêm sự kiện click cho mỗi nút
            showPasswordButtons.forEach(function(button) {
                button.addEventListener('click', function() {
                    // Tìm input password liền kề
                    const passwordInput = this.previousElementSibling;

                    // Chuyển đổi loại input giữa "password" và "text"
                    if (passwordInput.type === 'password') {
                        passwordInput.type = 'text';
                        // Thêm class active để CSS có thể thay đổi trạng thái hiển thị (nếu cần)
                        this.classList.add('active');
                    } else {
                        passwordInput.type = 'password';
                        // Xóa class active
                        this.classList.remove('active');
                    }
                });
            });
        });
    </script>
@endsection
