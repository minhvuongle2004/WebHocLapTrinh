<!-- Sidebar -->
<div class="stm_lms_user_float_menu __collapsed __position_left __logged_in">
    <div class="stm_lms_user_float_menu__toggle">
        <!-- Thay SVG bằng icon Font Awesome -->
        <i class="fas fa-bars" style="font-size:16px; color:#273044;"></i>
    </div>


    <!-- Ảnh đại diện -->
    <a href="{{ route('user.personal.show') }}" class="stm_lms_user_float_menu__user float_menu_item">
        <div class="stm_lms_user_float_menu__user_avatar">
            <!-- Thay $user->avatar bằng trường avatar trong CSDL -->
            <img src="{{ $user->avatar ? asset('storage/' . $user->avatar) : 'https://secure.gravatar.com/avatar/c91b9db5b89ee07e68ac57f3a5602ae8?s=215&#038;d=mm&#038;r=g' }}"
                class="avatar avatar-215 photo"
                style="width: 60px; height: 60px; border-radius: 50%; object-fit: cover;" />
        </div>

        <div class="stm_lms_user_float_menu__user_info">
            <h3>{{ $user->fullname ?? 'GuestUser' }}</h3>
            <span>{{ $user->role ?? 'Student' }}</span>
        </div>

        <div class="stm_lms_user_float_menu__user_settings">
            <i class="fas fa-cog"></i>
        </div>
    </a>

    <div class="stm_lms_user_float_menu__scrolled">
        <a href="{{ route('user.enrolled-courses') }}" class="float_menu_item float_menu_item__inline __icon">
            <span class="float_menu_item__title heading_font">Enrolled Courses</span>
            <i class="fa fa-book float_menu_item__icon"></i>
        </a>
        <a href="#" class="float_menu_item float_menu_item__inline __icon">
            <span class="float_menu_item__title heading_font">Messages</span>
            <i class="fa fa-envelope float_menu_item__icon"></i>
        </a>
        <a href="{{ route('user.wishlist.index') }}" class="float_menu_item float_menu_item__inline __icon">
            <span class="float_menu_item__title heading_font">Wishlist</span>
            <i class="fa fa-star float_menu_item__icon"></i>
        </a>
        <a href="#" class="float_menu_item float_menu_item__inline __icon">
            <span class="float_menu_item__title heading_font">Enrolled Quizzes</span>
            <i class="fa fa-question float_menu_item__icon"></i>
        </a>
        <a href="#" class="float_menu_item float_menu_item__inline __icon">
            <span class="float_menu_item__title heading_font">My Certificates</span>
            <i class="fa fa-medal float_menu_item__icon"></i>
        </a>
        <a href="#" class="float_menu_item float_menu_item__inline __icon">
            <span class="float_menu_item__title heading_font">My Assignments</span>
            <i class="fa fa-pen-nib float_menu_item__icon"></i>
        </a>
        <a href="#" class="float_menu_item float_menu_item__inline __icon">
            <span class="float_menu_item__title heading_font">My Points</span>
            <i class="fa fa-trophy float_menu_item__icon"></i>
        </a>
        <div class="stm_lms_user_float_menu__scrolled_label">
            <i class="fa fa-chevron-down"></i>
        </div>
    </div>

    <!-- Nút logout -->
    <a href="{{ route('user.logout') }}" class="stm-lms-logout-button">
        <i class="fas fa-power-off"></i>
        <span>Log out</span>
    </a>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const sidebar = document.querySelector('.stm_lms_user_float_menu');
        const mainContent = document.querySelector('.main-content');
        const toggleButton = document.querySelector('.stm_lms_user_float_menu__toggle');

        // Toggle sidebar on click
        toggleButton.addEventListener('click', function() {
            sidebar.classList.toggle('__collapsed');
            // Giữ nguyên mainContent hoặc tuỳ biến theo layout
            if (mainContent) {
                mainContent.classList.toggle('sidebar-expanded');
            }
        });
    });
</script>
