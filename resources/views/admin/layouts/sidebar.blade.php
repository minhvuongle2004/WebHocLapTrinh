<div class="sidebar" data-background-color="dark">
  <div class="sidebar-logo">
    <!-- Logo Header -->
    <div class="logo-header" data-background-color="dark">
      <a href="{{ route('admin.dashboard') }}" class="logo">
        <img src="{{ asset('assets/admin/images/kaiadmin/logo_light.svg') }}" alt="navbar brand" class="navbar-brand"
          height="20" />
      </a>
      <div class="nav-toggle">
        <button class="btn btn-toggle toggle-sidebar">
          <i class="gg-menu-right"></i>
        </button>
        <button class="btn btn-toggle sidenav-toggler">
          <i class="gg-menu-left"></i>
        </button>
      </div>
      <button class="topbar-toggler more">
        <i class="gg-more-vertical-alt"></i>
      </button>
    </div>
    <!-- End Logo Header -->
  </div>
  <div class="sidebar-wrapper scrollbar scrollbar-inner">
    <div class="sidebar-content">
      <ul class="nav nav-secondary">
        <li class="nav-section">
          <span class="sidebar-mini-icon">
            <i class="fa fa-ellipsis-h"></i>
          </span>
          <h4 class="text-section">Manager</h4>
        </li>

        <!-- Người dùng(Users) -->
        <li class="nav-item">
          <a data-bs-toggle="collapse" href="#formUser">
            <i class="fas fa-user"></i>
            <p>Người dùng</p>
            <span class="caret"></span>
          </a>
          <div class="collapse" id="formUser">
            <ul class="nav nav-collapse">
              <li>
                <a href="{{ route('admin.users.create') }}">
                  <span class="sub-item">Tạo mới người dùng</span>
                </a>
                <a href="{{ route('admin.users.index') }}">
                  <span class="sub-item">Danh sách người dùng</span>
                </a>
              </li>
            </ul>
          </div>
        </li>

        <!-- Danh mục(Categories) -->
        <li class="nav-item">
          <a data-bs-toggle="collapse" href="#formCat">
            <i class="fas fa-table"></i>
            <p>Danh mục</p>
            <span class="caret"></span>
          </a>
          <div class="collapse" id="formCat">
            <ul class="nav nav-collapse">
              <li>
                <a href="{{ route('admin.categories.create') }}">
                  <span class="sub-item">Tạo mới danh mục</span>
                </a>
                <a href="{{ route('admin.categories.index') }}">
                  <span class="sub-item">Danh sách danh mục</span>
                </a>
              </li>
            </ul>
          </div>
        </li>

        <!-- Khoá học(Course) -->
        <li class="nav-item">
          <a data-bs-toggle="collapse" href="#formCourse">
            <i class="fas fa-credit-card"></i>
            <p>Khoá học</p>
            <span class="caret"></span>
          </a>
          <div class="collapse" id="formCourse">
            <ul class="nav nav-collapse">
              <li>
                <a href="{{ route('admin.courses.create') }}">
                  <span class="sub-item">Tạo mới khoá học</span>
                </a>
                <a href="{{ route('admin.courses.index') }}">
                  <span class="sub-item">Danh sách khoá học</span>
                </a>
              </li>
            </ul>
          </div>
        </li>

        <!-- Bài giảng(Leson) -->
        <li class="nav-item">
          <a data-bs-toggle="collapse" href="#formLesson">
            <i class="fas fa-chalkboard-teacher"></i>
            <p>Bài giảng</p>
            <span class="caret"></span>
          </a>
          <div class="collapse" id="formLesson">
            <ul class="nav nav-collapse">
              <li>
                <a href="{{ route('admin.lessons.create') }}">
                  <span class="sub-item">Tạo mới bài giảng</span>
                </a>
                <a href="{{ route('admin.lessons.index') }}">
                  <span class="sub-item">Danh sách bài giảng</span>
                </a>
              </li>
            </ul>
          </div>
        </li>

        <!-- Thanh toán(Payment) -->
        <li class="nav-item">
          <a data-bs-toggle="collapse" href="#formPayment">
            <i class="fas fa-money-check-alt"></i>
            <p>Thanh toán</p>
            <span class="caret"></span>
          </a>
          <div class="collapse" id="formPayment">
            <ul class="nav nav-collapse">
              <li>
                <a href="{{ route('admin.payments.create') }}">
                  <span class="sub-item">Tạo mới thanh toán</span>
                </a>
                <a href="{{ route('admin.payments.index') }}">
                  <span class="sub-item">Danh sách thanh toán</span>
                </a>
              </li>
            </ul>
          </div>
        </li>

        <!-- Đánh giá(Rate) -->
        <li class="nav-item">
          <a data-bs-toggle="collapse" href="#formReview">
            <i class="fas fa-star"></i>
            <p>Đánh giá</p>
            <span class="caret"></span>
          </a>
          <div class="collapse" id="formReview">
            <ul class="nav nav-collapse">
              <li>
                <a href="{{ route('admin.reviews.create') }}">
                  <span class="sub-item">Tạo mới đánh giá</span>
                </a>
                <a href="{{ route('admin.reviews.index') }}">
                  <span class="sub-item">Danh sách đánh giá</span>
                </a>
              </li>
            </ul>
          </div>
        </li>

        <!-- Tin nhắn(Messages) -->
        <li class="nav-item">
          <a data-bs-toggle="collapse" href="#formMess">
            <i class="fab fa-facebook-messenger"></i>
            <p>Messages</p>
            <span class="caret"></span>
          </a>
          <div class="collapse" id="formMess">
            <ul class="nav nav-collapse">
              <li>
                <a href="{{ route('admin.messages.create') }}">
                  <span class="sub-item">Tạo mới tin nhắn</span>
                </a>
                <a href="{{ route('admin.messages.index') }}">
                  <span class="sub-item">Danh sách tin nhắn</span>
                </a>
              </li>
            </ul>
          </div>
        </li>

        <!-- Doanh thu(Incomes) -->
        <li class="nav-item">
          <a data-bs-toggle="collapse" href="#formIncome">
            <i class="fas fa-chart-line"></i>
            <p>Income</p>
            <span class="caret"></span>
          </a>
          <div class="collapse" id="formIncome">
            <ul class="nav nav-collapse">
              <li>
                <a href="{{ route('admin.incomes.create') }}">
                  <span class="sub-item">Tạo mới báo cáo doanh thu</span>
                </a>
                <a href="{{ route('admin.incomes.index') }}">
                  <span class="sub-item">Danh sách báo cáo doanh thu</span>
                </a>
              </li>
            </ul>
          </div>
        </li>

        <!-- Khoá học đã đăng ký(Course enrolled) -->
        <li class="nav-item">
          <a data-bs-toggle="collapse" href="#formEnrollment">
            <i class="fas fa-check-square"></i>
            <p>Khoá học đã đăng ký</p>
            <span class="caret"></span>
          </a>
          <div class="collapse" id="formEnrollment">
            <ul class="nav nav-collapse">
              <li>
                <a href="{{ route('admin.courseEnrolled.create') }}">
                  <span class="sub-item">Tạo mới khoá học đã được đăng ký</span>
                </a>
                <a href="{{ route('admin.courseEnrolled.index') }}">
                  <span class="sub-item">Danh sách khoá học đã đăng ký</span>
                </a>
              </li>
            </ul>
          </div>
        </li>

        <!-- Quản trị viên(Admin) -->
        <li class="nav-item">
          <a data-bs-toggle="collapse" href="#formAdmin">
            <i class="fas fa-users-cog"></i>
            <p>Quản trị viên</p>
            <span class="caret"></span>
          </a>
          <div class="collapse" id="formAdmin">
            <ul class="nav nav-collapse">
              <li>
                <a href="{{ route('admin.admins.create') }}">
                  <span class="sub-item">Tạo mới quản trị viên</span>
                </a>
                <a href="{{ route('admin.admins.index') }}">
                  <span class="sub-item">Danh sách quản trị viên</span>
                </a>
              </li>
            </ul>
          </div>
        </li>
      </ul>
    </div>
  </div>
</div>