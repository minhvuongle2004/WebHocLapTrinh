@extends('user.layouts.home')

@section('content')
    <div class="container-fluid px-4 py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold">Enrolled courses</h2>
        </div>

        <hr class="bg-primary" style="width: 200px; height: 3px; opacity: 1;">

        @php
            // Tính số lượng khóa học theo từng trạng thái (trạng thái bạn cần đảm bảo thống nhất với dữ liệu)
            $allCount = $coursesEnrolled->count();
            $completedCount = $coursesEnrolled->where('status', 'completed')->count();
            $inProgressCount = $coursesEnrolled->where('status', 'in_progress')->count();
            $failedCount = $coursesEnrolled->where('status', 'failed')->count();
        @endphp

        <div class="row mb-4">
            <div class="col-md-3">
                <div class="card status-tab active">
                    <a href="#" class="card-body d-flex align-items-center">
                        <div class="status-icon all-icon">
                            <i class="bi bi-collection"></i>
                        </div>
                        <div>
                            <div>All</div>
                            <h3 class="mb-0">{{ $allCount }}</h3>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card status-tab">
                    <a href="#" class="card-body d-flex align-items-center">
                        <div class="status-icon completed-icon">
                            <i class="bi bi-check-circle"></i>
                        </div>
                        <div>
                            <div>Completed</div>
                            <h3 class="mb-0">{{ $completedCount }}</h3>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card status-tab">
                    <a href="#" class="card-body d-flex align-items-center">
                        <div class="status-icon progress-icon">
                            <i class="bi bi-pencil-square"></i>
                        </div>
                        <div>
                            <div>In progress</div>
                            <h3 class="mb-0">{{ $inProgressCount }}</h3>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card status-tab">
                    <div class="card-body d-flex align-items-center">
                        <div class="status-icon failed-icon">
                            <i class="bi bi-x-circle"></i>
                        </div>
                        <div>
                            <div>Failed</div>
                            <h3 class="mb-0">{{ $failedCount }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            @forelse($coursesEnrolled as $courseEnrolled)
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <!-- Sử dụng thumbnail từ bảng courses; nếu không có sẽ dùng ảnh mặc định -->
                        <img src="{{ asset('storage/' . $courseEnrolled->course->thumbnail ?? 'assets/user/wp-content/uploads/default.png') }}"
                            class="card-img-top" alt="{{ $courseEnrolled->course->title }}">
                        <div class="card-body d-flex flex-column">
                            <!-- Hiển thị tên chuyên mục nếu tồn tại trong quan hệ course->category -->
                            <div class="small text-muted mb-2">
                                {{ $courseEnrolled->course->category->name ?? 'Khóa học' }}
                            </div>
                            <!-- Hiển thị tiêu đề khóa học lấy từ bảng courses -->
                            <h5 class="card-title">{{ $courseEnrolled->course->title }}</h5>
                            <!-- Thông tin bổ sung, ví dụ level của khóa học -->
                            <div class="text-muted small mb-2">{{ $courseEnrolled->course->level ?? '' }}</div>
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <small>{{ $courseEnrolled->progess }}% Complete</small>
                            </div>
                            <div class="progress mb-4">
                                <div class="progress-bar {{ $courseEnrolled->progess > 0 ? 'bg-success' : '' }}"
                                    role="progressbar" style="width: {{ $courseEnrolled->progess }}%"
                                    aria-valuenow="{{ $courseEnrolled->progess }}" aria-valuemin="0" aria-valuemax="100">
                                </div>
                            </div>
                            <!-- Link điều hướng đến trang chi tiết khóa học, đảm bảo định nghĩa route phù hợp -->
                            <a href="{{ route('user.course-detail', $courseEnrolled->id_course) }}"
                                class="btn {{ $courseEnrolled->progess > 0 ? 'btn-success' : 'btn-primary' }} mt-auto text-center py-3">
                                {{ $courseEnrolled->progess > 0 ? 'CONTINUE' : 'START COURSE' }}
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-info">Bạn chưa đăng ký khóa học nào.</div>
                </div>
            @endforelse
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const statusTabs = document.querySelectorAll('.status-tab');

            statusTabs.forEach(tab => {
                tab.addEventListener('click', function() {
                    statusTabs.forEach(t => t.classList.remove('active'));
                    this.classList.add('active');
                    // Thêm logic lọc theo trạng thái nếu cần
                });
            });
        });
    </script>
@endsection
