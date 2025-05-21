@extends('user.layouts.home')

@section('content')
    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Thông báo',
                text: '{{ session('success') }}',
                confirmButtonText: 'OK'
            });
        </script>
    @endif
    @if (session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Thông báo',
                text: '{{ session('error') }}',
                confirmButtonText: 'OK'
            });
        </script>
    @endif
    <style>
        /* Reset and Base Styles */
        .personal-container *,
        .personal-container *::before,
        .personal-container *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        .personal-container {
            font-family: 'Inter', sans-serif;
            color: #333;
            line-height: 1.5;
            background-color: #fff;
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem;
        }

        /* Profile Layout */
        .personal-profile-container {
            display: flex;
            gap: 2rem;
        }

        .personal-profile-sidebar {
            flex: 0 0 250px;
        }

        .personal-profile-content {
            flex: 1;
        }

        /* Profile Picture */
        .personal-profile-picture {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            background-color: #ccc;
            margin: 0 auto 1rem;
            overflow: hidden;
            position: relative;
        }

        .personal-profile-picture img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        /* User Info */
        .personal-user-info {
            text-align: center;
            margin-bottom: 2rem;
        }

        .personal-user-name {
            font-size: 1.25rem;
            font-weight: 600;
            margin-bottom: 0.25rem;
        }

        .personal-user-role {
            color: #666;
        }

        /* Question Card */
        .personal-question-card {
            border: 1px solid #e5e7eb;
            border-radius: 0.5rem;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
        }

        .personal-question-card h3 {
            font-size: 1.125rem;
            margin-bottom: 0.5rem;
        }

        .personal-question-card p {
            font-size: 0.875rem;
            color: #666;
            margin-bottom: 1rem;
        }

        .personal-btn-request {
            background-color: #10b981;
            color: white;
            border: none;
            border-radius: 0.25rem;
            padding: 0.75rem 1rem;
            font-weight: 500;
            width: 100%;
            cursor: pointer;
            transition: background-color 0.2s;
        }

        .personal-btn-request:hover {
            background-color: #059669;
        }

        /* Profile Header */
        .personal-profile-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }

        .personal-profile-title {
            font-size: 1.75rem;
            font-weight: 700;
            color: #333;
        }

        .personal-coin-icon {
            width: 40px;
            height: 40px;
            background-color: #fef3c7;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 0.5rem;
            font-weight: 600;
            color: #92400e;
        }

        /* Profile Tabs */
        .personal-profile-tabs {
            margin-bottom: 2rem;
            border-bottom: 1px solid #e5e7eb;
        }

        .personal-tab-indicator {
            width: 60px;
            height: 3px;
            background-color: #2563eb;
            margin-bottom: -1px;
        }

        /* Form Sections */
        .personal-form-section {
            background-color: #f3f4f6;
            border-radius: 0.5rem;
            padding: 1.5rem;
            margin-bottom: 2rem;
        }

        .personal-form-title {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
        }

        .personal-form-row {
            display: flex;
            gap: 1.5rem;
            margin-bottom: 1.5rem;
        }

        .personal-form-group {
            flex: 1;
            margin-bottom: 1rem;
        }

        .personal-form-label {
            display: block;
            font-weight: 500;
            margin-bottom: 0.5rem;
        }

        .personal-form-control {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #d1d5db;
            border-radius: 0.25rem;
            font-family: inherit;
            font-size: 1rem;
        }

        .personal-form-control:focus {
            outline: none;
            border-color: #2563eb;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
        }

        .personal-form-select {
            width: 100%;
            height: 45px;
            /* Fixed height for better appearance */
            padding: 0.75rem;
            border: 1px solid #d1d5db;
            border-radius: 0.25rem;
            font-family: inherit;
            font-size: 1rem;
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' fill='none' viewBox='0 0 12 12'%3E%3Cpath stroke='%236B7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='m3 5 3 3 3-3'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 0.75rem center;
            background-size: 1rem;
        }

        .personal-form-select:focus {
            outline: none;
            border-color: #2563eb;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
        }

        .personal-form-hint {
            font-size: 0.875rem;
            color: #6b7280;
            margin-top: 0.5rem;
        }

        /* Password Field */
        .personal-password-field {
            position: relative;
        }

        .personal-password-toggle {
            position: absolute;
            right: 0.75rem;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            cursor: pointer;
            color: #9ca3af;
        }

        /* Form Actions */
        .personal-form-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 2rem;
        }

        .personal-btn-primary {
            background-color: #2563eb;
            color: white;
            border: none;
            border-radius: 9999px;
            padding: 0.75rem 2rem;
            font-weight: 500;
            cursor: pointer;
            transition: background-color 0.2s;
        }

        .personal-btn-primary:hover {
            background-color: #1d4ed8;
        }

        .personal-btn-logout {
            background-color: #f3f4f6;
            color: #374151;
            border: none;
            border-radius: 9999px;
            padding: 0.75rem 1.5rem;
            font-weight: 500;
            cursor: pointer;
            transition: background-color 0.2s;
            display: flex;
            align-items: center;
            text-decoration: none;
        }

        .personal-btn-logout:hover {
            background-color: #e5e7eb;
        }

        .personal-btn-logout svg {
            margin-right: 0.5rem;
        }

        /* Error and Success Messages */
        .personal-form-control.personal-error {
            border-color: #ef4444;
            box-shadow: 0 0 0 1px #ef4444;
        }

        .personal-form-error-message {
            color: #ef4444;
            font-size: 0.875rem;
            margin-top: 0.25rem;
            display: none;
        }

        .personal-form-error-message.personal-show {
            display: block;
        }

        .personal-form-group.personal-has-error .personal-form-label {
            color: #ef4444;
        }

        /* Animation cho thông báo lỗi */
        @keyframes personal-shake {

            0%,
            100% {
                transform: translateX(0);
            }

            25% {
                transform: translateX(-5px);
            }

            75% {
                transform: translateX(5px);
            }
        }

        .personal-form-error-message.personal-show {
            animation: personal-shake 0.4s ease-in-out;
        }

        /* Success message */
        .personal-success-message {
            background-color: #d1fae5;
            border-left: 4px solid #10b981;
            color: #065f46;
            padding: 1rem;
            margin-bottom: 1.5rem;
            border-radius: 0.25rem;
            animation: personal-fade-in 0.5s ease-in-out;
        }

        @keyframes personal-fade-in {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Responsive */
        @media (max-width: 768px) {
            .personal-profile-container {
                flex-direction: column;
            }

            .personal-profile-sidebar {
                flex: 0 0 auto;
                margin-bottom: 2rem;
            }

            .personal-form-row {
                flex-direction: column;
                gap: 1rem;
            }
        }

        .personal-profile-picture {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            background-color: #ccc;
            margin: 0 auto 1rem;
            overflow: hidden;
            position: relative;
            cursor: pointer;
        }

        .personal-profile-picture img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: filter 0.3s ease;
        }

        .profile-picture-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            color: white;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .profile-picture-overlay i {
            font-size: 24px;
            margin-bottom: 5px;
        }

        .profile-picture-overlay span {
            font-size: 12px;
        }

        .personal-profile-picture:hover .profile-picture-overlay {
            opacity: 1;
        }

        .personal-profile-picture:hover img {
            filter: blur(2px);
        }
    </style>

    <div class="personal-container">
        @if (session('success'))
            <div class="personal-success-message">
                {{ session('success') }}
            </div>
        @endif

        <div class="personal-profile-container">
            <!-- Profile Sidebar -->
            <div class="personal-profile-sidebar">
                <div class="personal-profile-picture">
                    @if (isset($user->avatar) && $user->avatar)
                        <img id="profile-image" src="{{ asset('storage/' . $user->avatar) }}" alt="Profile Picture">
                    @else
                        <img id="profile-image" src="{{ asset('images/default-avatar.png') }}"
                            alt="Default Profile Picture">
                    @endif
                    <div class="profile-picture-overlay">
                        <i class="fas fa-camera"></i>
                        <span>Change Photo</span>
                    </div>
                    <input type="file" id="avatar-upload" name="avatar" accept="image/*" style="display: none;">
                </div>

                <div class="personal-user-info">
                    <h2 class="personal-user-name">{{ $user->username ?? 'LmaoSama' }}</h2>
                    <p class="personal-user-role">{{ $user->role ?? 'Student' }}</p>
                </div>

                {{-- <div class="personal-question-card">
                    <h3>Have a question?</h3>
                    <p>Here you can send a direct request to the site owner.</p>
                    <button class="personal-btn-request">SEND REQUEST</button>
                </div> --}}
            </div>

            <!-- Profile Content -->
            <div class="personal-profile-content">
                <div class="personal-profile-header">
                    <h1 class="personal-profile-title">My profile</h1>
                </div>

                <div class="personal-profile-tabs">
                    <div class="personal-tab-indicator"></div>
                </div>

                <form id="personal-profile-form" action="{{ route('user.personal.update') }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Profile Information -->
                    <div class="personal-form-section">
                        <div class="personal-form-row">
                            <div class="personal-form-group">
                                <label for="personal-name" class="personal-form-label">Name</label>
                                <input type="text" id="personal-name" name="name"
                                    class="personal-form-control @error('name') personal-error @enderror"
                                    placeholder="Enter your name" value="{{ old('name', $user->username ?? '') }}">
                                <div class="personal-form-error-message @error('name') personal-show @enderror"
                                    id="personal-name-error">
                                    @error('name')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="personal-form-group">
                            <label for="personal-display-name" class="personal-form-label">Display name publicly as:</label>
                            <select id="personal-display-name" name="display_name"
                                class="personal-form-select @error('display_name') personal-error @enderror">
                                <option value="full_name"
                                    {{ ($user->display_name_option ?? '') == 'full_name' ? 'selected' : '' }}>
                                    {{ $user->displayname ?? 'LmaoSama' }}
                                </option>
                                {{-- <option value="username"
                                    {{ ($user->display_name_option ?? '') == 'username' ? 'selected' : '' }}>
                                    {{ $user->username ?? 'LmaoSama' }}
                                </option> --}}
                            </select>
                            <div class="personal-form-error-message @error('display_name') personal-show @enderror"
                                id="personal-display-name-error">
                                @error('display_name')
                                    {{ $message }}
                                @enderror
                            </div>
                            <p class="personal-form-hint">
                                The display name is shown in all public fields, such as the author name, instructor name,
                                student name
                            </p>
                        </div>
                    </div>

                    <!-- Change Password -->
                    <h2 class="personal-form-title">Change Password</h2>
                    <div class="personal-form-section">
                        <div class="personal-form-row">
                            <div class="personal-form-group">
                                <label for="personal-new-password" class="personal-form-label">New Password</label>
                                <div class="personal-password-field">
                                    <input type="password" id="personal-new-password" name="new_password"
                                        class="personal-form-control @error('new_password') personal-error @enderror"
                                        placeholder="Enter your new password">
                                    <button type="button" class="personal-password-toggle"
                                        data-target="personal-new-password">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                            <circle cx="12" cy="12" r="3"></circle>
                                        </svg>
                                    </button>
                                </div>
                                <div class="personal-form-error-message @error('new_password') personal-show @enderror"
                                    id="personal-new-password-error">
                                    @error('new_password')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>

                            <div class="personal-form-group">
                                <label for="personal-new-password-confirmation" class="personal-form-label">Re-type New
                                    Password</label>
                                <div class="personal-password-field">
                                    <input type="password" id="personal-new-password-confirmation"
                                        name="new_password_confirmation"
                                        class="personal-form-control @error('new_password_confirmation') personal-error @enderror"
                                        placeholder="Enter your new password again">
                                    <button type="button" class="personal-password-toggle"
                                        data-target="personal-new-password-confirmation">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                            <circle cx="12" cy="12" r="3"></circle>
                                        </svg>
                                    </button>
                                </div>
                                <div class="personal-form-error-message @error('new_password_confirmation') personal-show @enderror"
                                    id="personal-new-password-confirmation-error">
                                    @error('new_password_confirmation')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Form Actions -->
                </form>
                <div class="personal-form-actions">
                    <button type="submit" class="personal-btn-primary">SAVE CHANGES</button>
                    <a href="#" class="personal-btn-logout"
                        onclick="event.preventDefault(); document.getElementById('personal-logout-form').submit();">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                            <polyline points="16 17 21 12 16 7"></polyline>
                            <line x1="21" y1="12" x2="9" y2="12"></line>
                        </svg>
                        Log out
                    </a>
                    <form id="personal-logout-form" action="{{ route('user.logout') }}" method="POST"
                        style="display: none;">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Password visibility toggle
            const passwordToggles = document.querySelectorAll('.personal-password-toggle');

            passwordToggles.forEach(toggle => {
                toggle.addEventListener('click', function() {
                    const targetId = this.getAttribute('data-target');
                    const passwordInput = document.getElementById(targetId);

                    if (passwordInput.type === 'password') {
                        passwordInput.type = 'text';
                        this.innerHTML = `
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"></path>
                            <line x1="1" y1="1" x2="23" y2="23"></line>
                        </svg>
                    `;
                    } else {
                        passwordInput.type = 'password';
                        this.innerHTML = `
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                            <circle cx="12" cy="12" r="3"></circle>
                        </svg>
                    `;
                    }
                });
            });

            // Form validation
            const profileForm = document.getElementById("personal-profile-form");

            // Hàm hiển thị lỗi
            function showError(inputElement, message) {
                // Tìm phần tử cha .personal-form-group
                const formGroup = inputElement.closest('.personal-form-group');
                // Thêm class lỗi
                formGroup.classList.add('personal-has-error');
                // Thêm class lỗi cho input
                inputElement.classList.add('personal-error');

                // Tìm phần tử hiển thị lỗi
                const errorElement = document.getElementById(`${inputElement.id}-error`);
                if (errorElement) {
                    // Hiển thị thông báo lỗi
                    errorElement.textContent = message;
                    errorElement.classList.add('personal-show');

                    // Tự động ẩn thông báo lỗi sau 5 giây
                    setTimeout(() => {
                        errorElement.classList.remove('personal-show');
                    }, 5000);
                }

                // Focus vào trường lỗi
                inputElement.focus();
            }

            // Hàm xóa lỗi
            function clearError(inputElement) {
                // Tìm phần tử cha .personal-form-group
                const formGroup = inputElement.closest('.personal-form-group');
                // Xóa class lỗi
                formGroup.classList.remove('personal-has-error');
                // Xóa class lỗi cho input
                inputElement.classList.remove('personal-error');

                // Tìm phần tử hiển thị lỗi
                const errorElement = document.getElementById(`${inputElement.id}-error`);
                if (errorElement) {
                    // Ẩn thông báo lỗi
                    errorElement.textContent = '';
                    errorElement.classList.remove('personal-show');
                }
            }

            // Xóa lỗi khi người dùng bắt đầu nhập lại
            document.querySelectorAll('.personal-form-control').forEach(input => {
                input.addEventListener('input', function() {
                    clearError(this);
                });
            });

            // Tự động ẩn thông báo thành công sau 5 giây
            const successMessage = document.querySelector('.personal-success-message');
            if (successMessage) {
                setTimeout(() => {
                    successMessage.style.opacity = '0';
                    successMessage.style.transition = 'opacity 0.5s ease';

                    setTimeout(() => {
                        successMessage.style.display = 'none';
                    }, 500);
                }, 5000);
            }

            profileForm.addEventListener("submit", (event) => {
                let hasError = false;
                const newPassword = document.getElementById("personal-new-password");
                const confirmPassword = document.getElementById("personal-new-password-confirmation");
                const nameInput = document.getElementById("personal-name");

                // Xóa tất cả lỗi trước khi kiểm tra
                document.querySelectorAll('.personal-form-control').forEach(input => {
                    clearError(input);
                });

                // Kiểm tra tên
                if (!nameInput.value.trim()) {
                    event.preventDefault();
                    showError(nameInput, "Name is required");
                    hasError = true;
                }

                // Nếu có nhập mật khẩu mới
                if (newPassword.value || confirmPassword.value) {
                    // Kiểm tra độ dài mật khẩu
                    if (newPassword.value.length < 8) {
                        event.preventDefault();
                        showError(newPassword, "Password must be at least 8 characters long");
                        hasError = true;
                    }

                    // Kiểm tra mật khẩu khớp nhau
                    if (newPassword.value !== confirmPassword.value) {
                        event.preventDefault();
                        showError(confirmPassword, "Passwords do not match");
                        hasError = true;
                    }
                }

                return !hasError;
            });
        });
    </script>

    {{-- Update ảnh --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const profilePicture = document.querySelector('.personal-profile-picture');
            const fileInput = document.getElementById('avatar-upload');
            const profileImage = document.getElementById('profile-image');

            // Khi click vào ảnh đại diện
            profilePicture.addEventListener('click', function() {
                fileInput.click();
            });

            // Khi file được chọn
            fileInput.addEventListener('change', function() {
                if (this.files && this.files[0]) {
                    const file = this.files[0];

                    // Kiểm tra kích thước file (giới hạn 2MB)
                    if (file.size > 2 * 1024 * 1024) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Dung lượng ảnh quá lớn',
                            text: 'Vui lòng chọn ảnh có dung lượng nhỏ hơn 2MB'
                        });
                        return;
                    }

                    // Kiểm tra loại file
                    if (!file.type.startsWith('image/')) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Sai định dạng file',
                            text: 'Vui lòng chọn đúng định dạng file ảnh'
                        });
                        return;
                    }

                    // Hiển thị loading
                    Swal.fire({
                        title: 'Đang cập nhật...',
                        text: 'Vui lòng chờ trong giây lát',
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });

                    // Tạo FormData để upload file
                    const formData = new FormData();
                    formData.append('avatar', file);
                    formData.append('_token', '{{ csrf_token() }}');

                    // Gửi request để upload file
                    fetch('{{ route('user.avatar.update') }}', {
                            method: 'POST',
                            body: formData,
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                // Hiển thị ảnh mới
                                profileImage.src = data.avatar_url;

                                // Hiển thị thông báo thành công
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Thành công!',
                                    text: 'Hồ sơ của bạn đã được cập nhật',
                                    timer: 2000,
                                    showConfirmButton: false
                                });
                            } else {
                                // Hiển thị thông báo lỗi
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Lỗi!',
                                    text: data.message || 'Lỗi khi cập nhật ảnh hồ sơ',
                                });
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            Swal.fire({
                                icon: 'error',
                                title: 'Lỗi!',
                                text: 'Lỗi khi cập nhật ảnh hồ sơ'
                            });
                        });
                }
            });

            // Thêm các event listener khác ở đây
            // Như password toggle, form validation, etc.
        });
    </script>
@endsection
