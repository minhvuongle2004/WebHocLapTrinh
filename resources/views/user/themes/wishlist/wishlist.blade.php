@extends('user.layouts.home')

@section('content')
    <div class="container">
        <!-- Header khu vực -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold mb-0">Wishlist</h2>
        </div>

        <!-- Đường kẻ xanh dương -->
        <div class="border-top border-3 border-primary mb-4" style="width: 80px;"></div>

        @if (session('success'))
            <div class="alert alert-success mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if (count($notifications) > 0)
            <div class="card mb-4">
                <div class="card-header">
                    <h5>Thông báo mới ({{ count($notifications) }})</h5>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        @foreach ($notifications as $notification)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <a
                                        href="{{ route('user.course-detail', $notification->course_id) }}">{{ $notification->message }}</a>
                                    <div class="text-muted small">{{ $notification->created_at->diffForHumans() }}</div>
                                </div>
                                <button class="btn btn-sm btn-outline-secondary mark-as-read"
                                    data-notification-id="{{ $notification->id }}"
                                    data-url="{{ route('user.wishlist.notification.read', $notification->id) }}">
                                    Đánh dấu đã đọc
                                </button>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

        @if (count($wishlistItems) > 0)
            <div class="row">
                @foreach ($wishlistItems as $course)
                    <div class="col-md-4 mb-4">
                        <div class="card border-0 shadow-sm h-100">
                            <div class="position-relative">
                                @if ($course->thumbnail)
                                    <img src="{{ asset('storage/' . $course->thumbnail) }}" class="card-img-top"
                                        alt="{{ $course->title }}" style="height: 230px; object-fit: cover;">
                                @else
                                    <div class="bg-light d-flex align-items-center justify-content-center"
                                        style="height: 230px;">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1"
                                            stroke-linecap="round" stroke-linejoin="round">
                                            <rect x="3" y="3" width="18" height="18" rx="2" ry="2">
                                            </rect>
                                            <circle cx="8.5" cy="8.5" r="1.5"></circle>
                                            <polyline points="21 15 16 10 5 21"></polyline>
                                        </svg>
                                    </div>
                                @endif
                            </div>

                            <div class="card-body d-flex flex-column p-4">
                                <div class="mb-2">
                                    <span class="text-muted">{{ $course->category->name ?? 'Java Fullstack' }}</span>
                                </div>

                                <h5 class="card-title fw-bold mb-3">
                                    <a href="{{ route('user.course-detail', $course->id) }}"
                                        class="text-decoration-none text-dark">
                                        {{ $course->title ?? '[Video] Lập trình viên Java Web Fullstack: React kết hợp Spring Boot' }}
                                    </a>
                                </h5>

                                <div class="mt-auto d-flex justify-content-between">
                                    <div class="fw-bold">{{ number_format($course->price ?? 399000) }} đ</div>
                                    <form action="{{ route('user.wishlist.remove', $course->id) }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger">
                                            <i class="fa fa-heart-broken"></i> Xóa
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="alert alert-info">
                <p class="mb-0">Chưa có khóa học nào trong danh sách yêu thích.</p>
                <a href="{{ route('user.index') }}" class="alert-link">Khám phá các khóa học ngay</a>
            </div>
        @endif
    </div>

    @push('scripts')
        <script>
            $(document).ready(function() {
                // Xử lý sự kiện đánh dấu đã đọc thông báo
                $('.mark-as-read').on('click', function() {
                    const notificationId = $(this).data('notification-id');
                    const url = $(this).data('url');
                    const button = $(this);

                    $.ajax({
                        url: url,
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            if (response.status === 'success') {
                                // Ẩn thông báo đã đọc
                                button.closest('li').fadeOut(300, function() {
                                    $(this).remove();

                                    // Kiểm tra nếu không còn thông báo nào thì ẩn container
                                    if ($('.list-group-item').length === 0) {
                                        $('.card.mb-4').fadeOut();
                                    }
                                });
                            }
                        }
                    });
                });
            });
        </script>
    @endpush
@endsection
