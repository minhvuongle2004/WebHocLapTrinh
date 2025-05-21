<li class="nav-item topbar-icon dropdown hidden-caret">
    <a class="nav-link dropdown-toggle" href="#" id="notifDropdown" role="button" data-bs-toggle="dropdown"
        aria-haspopup="true" aria-expanded="false">
        <i class="fa fa-bell"></i>
        @if ($unreadCount > 0)
            <span class="notification">{{ $unreadCount }}</span>
        @endif
    </a>
    <ul class="dropdown-menu notif-box animated fadeIn" aria-labelledby="notifDropdown">
        <li>
            <div class="dropdown-title">
                Bạn có {{ $unreadCount }} thông báo mới
            </div>
        </li>
        <li>
            <div class="notif-scroll scrollbar-outer">
                <div class="notif-center">
                    @forelse($notifications as $notification)
                        <a href="{{ route('admin.notifications.read', $notification->id) }}">
                            @if ($notification->image)
                                <div class="notif-img">
                                    <img src="{{ asset($notification->image) }}" alt="Notification Image" />
                                </div>
                            @else
                                <div class="notif-icon notif-{{ $notification->icon_color ?? 'primary' }}">
                                    <i class="fa {{ $notification->icon }}"></i>
                                </div>
                            @endif
                            <div class="notif-content">
                                <span class="block">{{ $notification->title }}</span>
                                <span class="time">{{ $notification->created_at->diffForHumans() }}</span>
                            </div>
                        </a>
                    @empty
                        <div class="text-center p-3">
                            <span>Không có thông báo mới</span>
                        </div>
                    @endforelse
                </div>
            </div>
        </li>
        <li>
            <div class="d-flex justify-content-between">
                <a class="see-all" href="{{ route('admin.notifications.index') }}">
                    Xem tất cả<i class="fa fa-angle-right"></i>
                </a>
                @if ($unreadCount > 0)
                    <form action="{{ route('admin.notifications.markAllAsRead') }}" method="POST" class="ml-2">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 see-all">Đánh dấu đã đọc</button>
                    </form>
                @endif
            </div>
        </li>
    </ul>
</li>
