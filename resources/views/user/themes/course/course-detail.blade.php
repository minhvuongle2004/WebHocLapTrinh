@extends('user.layouts.home')
@section('content')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        /* CSS mới cho các nút */
        .stm-course-sidebar-actions {
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-top: 1px solid #f0f3f5;
            border-bottom: 1px solid #f0f3f5;
            padding: 15px 0;
        }

        /* Kiểu dáng nút wishlist */
        .stm-course-wishlist-wrapper {
            flex: 1;
        }

        .stm-wishlist-link {
            display: flex;
            align-items: center;
            text-decoration: none;
            color: #273044;
            transition: all 0.3s ease;
            background: none;
            border: none;
            padding: 0;
            cursor: pointer;
        }

        .stm-wishlist-link:hover {
            opacity: 0.8;
        }

        .stm-wishlist-icon {
            color: #e53935;
            margin-right: 8px;
            font-size: 16px;
        }

        .stm-wishlist-text {
            font-size: 16px;
            font-weight: 400;
        }

        /* Kiểu dáng nút share */
        .stm-course-share {
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            padding: 0 10px;
        }

        .stm-share-text {
            font-size: 14px;
            font-weight: 400;
            color: #273044;
        }

        .stm-course-share:hover .stm-share-text {
            color: #e53935;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .stm-course-sidebar-actions {
                flex-direction: column;
                gap: 15px;
            }

            .stm-course-wishlist-wrapper,
            .stm-course-share {
                width: 100%;
                justify-content: flex-start;
            }
        }

        /* Popup Share */
        /* Share Button */
        .yt-share-button {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            background-color: #065fd4;
            color: white;
            border: none;
            border-radius: 18px;
            padding: 8px 16px;
            font-size: 14px;
            cursor: pointer;
            transition: background-color 0.2s;
        }

        .yt-share-button:hover {
            background-color: #0356c2;
        }

        /* Share Overlay */
        .yt-share-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.6);
            display: none;
            justify-content: center;
            align-items: center;
            z-index: 9999;
        }

        /* Share Popup */
        .yt-share-popup {
            background-color: white;
            border-radius: 12px;
            width: 90%;
            max-width: 480px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
            animation: yt-share-popup-animation 0.3s ease-out;
        }

        @keyframes yt-share-popup-animation {
            from {
                transform: scale(0.8);
                opacity: 0;
            }

            to {
                transform: scale(1);
                opacity: 1;
            }
        }

        /* Share Header */
        .yt-share-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 16px;
            border-bottom: 1px solid #e5e5e5;
        }

        .yt-share-header h3 {
            font-size: 18px;
            font-weight: 500;
            margin: 0;
        }

        .yt-share-close-button {
            background: transparent;
            border: none;
            cursor: pointer;
            color: #606060;
            padding: 4px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .yt-share-close-button:hover {
            color: #000;
        }

        /* Share Content */
        .yt-share-content {
            padding: 16px;
        }

        .yt-share-info {
            text-align: center;
            color: #606060;
            font-size: 14px;
            margin-bottom: 16px;
        }

        .yt-share-divider {
            height: 1px;
            background-color: #e5e5e5;
            margin: 16px 0;
        }

        .yt-share-content h4 {
            font-size: 16px;
            margin-bottom: 16px;
            font-weight: 500;
            margin-top: 0;
        }

        /* Share Options */
        .yt-share-options {
            display: flex;
            overflow-x: auto;
            gap: 16px;
            padding-bottom: 16px;
            margin-bottom: 16px;
        }

        .yt-share-option {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 8px;
            cursor: pointer;
            min-width: 64px;
        }

        .yt-share-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
        }

        .yt-share-option span {
            font-size: 12px;
            color: #606060;
        }

        .yt-share-embed-icon {
            background-color: #f2f2f2;
            color: #606060;
        }

        .yt-share-whatsapp-icon {
            background-color: #25D366;
        }

        .yt-share-facebook-icon {
            background-color: #3b5998;
        }

        .yt-share-twitter-icon {
            background-color: #000;
        }

        .yt-share-email-icon {
            background-color: #D3D3D3;
            color: #606060;
        }

        /* URL Container */
        .yt-share-url-container {
            display: flex;
            border: 1px solid #e5e5e5;
            border-radius: 4px;
            overflow: hidden;
        }

        .yt-share-url-input {
            flex: 1;
            padding: 12px;
            border: none;
            background-color: #f9f9f9;
            font-size: 14px;
            color: #606060;
        }

        .yt-share-copy-button {
            background-color: #065fd4;
            color: white;
            border: none;
            padding: 0 16px;
            cursor: pointer;
            font-size: 14px;
            font-weight: 500;
            transition: background-color 0.2s;
        }

        .yt-share-copy-button:hover {
            background-color: #0356c2;
        }

        .yt-share-copy-button.yt-share-copied {
            background-color: #4CAF50;
        }

        /* Responsive */
        @media (max-width: 480px) {
            .yt-share-popup {
                width: 95%;
                max-height: 90vh;
                overflow-y: auto;
            }

            .yt-share-options {
                justify-content: flex-start;
            }
        }
    </style>
    @if (session('error'))
        <script>
            Swal.fire({
                icon: 'info',
                title: 'Thông báo',
                text: '{{ session('error') }}',
                confirmButtonText: 'OK'
            });
        </script>
    @endif
    <div class="stm-lms-wrapper">
        <div class="container">
            <div class="masterstudy-single-course-sleek-sidebar">
                <!-- Sidebar Topbar -->
                <div class="masterstudy-single-course-sleek-sidebar__topbar">
                    <div class="masterstudy-single-course-sleek-sidebar__sticky">
                        <div
                            class="masterstudy-single-course-sleek-sidebar__sticky-wrapper masterstudy-single-course-sleek-sidebar__sticky-wrapper_on">
                            <!-- Thumbnail dynamic -->
                            <img class="masterstudy-single-course-thumbnail"
                                src="{{ $course->thumbnail ? asset('storage/' . $course->thumbnail) : asset('assets/user/wp-content/uploads/2023/07/lap-trinh-c-300-%c3%97-152-px.png') }}"
                                alt="{{ $course->title }}">
                            <div class="masterstudy-single-course-sleek-sidebar__sticky-block">
                                <div class="masterstudy-single-course-expired">
                                    Course available for <strong>{{ $course->available_days ?? '180' }} days</strong>
                                </div>
                                <div class="masterstudy-single-course-sleek-sidebar__cta">
                                    <div class="masterstudy-buy-button">
                                        <a href="{{ route('user.course-payment', $course->id) }}"
                                            class="masterstudy-buy-button__link" data-authorization-modal="login">
                                            <span class="masterstudy-buy-button__title">Get course</span>
                                            <span class="masterstudy-buy-button__separator"></span>
                                            <span class="masterstudy-buy-button__price">
                                                <span class="masterstudy-buy-button__price_regular">
                                                    {{ $course->price ? number_format($course->price) . ' đ' : 'Free' }}
                                                </span>
                                            </span>
                                        </a>
                                    </div>
                                </div>
                                <div class="masterstudy-single-course-stickybar">
                                    <div class="masterstudy-single-course-stickybar__wrapper">
                                        <div class="masterstudy-single-course-stickybar__column">
                                            <div class="masterstudy-single-course-stickybar__title">
                                                {{ $course->video_title ?? $course->title }}
                                            </div>
                                            <div class="masterstudy-single-course-stickybar__row">
                                                <div
                                                    class="masterstudy-single-course-instructor masterstudy-single-course-instructor_no-title">
                                                    <div class="masterstudy-single-course-instructor__avatar">
                                                        <img src="" class="avatar avatar-215 photo" />
                                                    </div>
                                                    <div class="masterstudy-single-course-instructor__info">
                                                    </div>
                                                </div>
                                                <div
                                                    class="masterstudy-single-course-categories masterstudy-single-course-categories_only-one">
                                                    <div class="masterstudy-single-course-categories__wrapper">
                                                        <div class="masterstudy-single-course-categories__container">
                                                            <span class="masterstudy-single-course-categories__icon"></span>
                                                            <div class="masterstudy-single-course-categories__list">
                                                                <span class="masterstudy-single-course-categories__title">
                                                                    Category:
                                                                </span>
                                                                <div
                                                                    class="masterstudy-single-course-categories__item-wrapper">
                                                                    @if ($course->category)
                                                                        <a class="masterstudy-single-course-categories__item"
                                                                            href="{{ route('user.course', $course->category->id) }}"
                                                                            target="_blank">
                                                                            {{ $course->category->name }}
                                                                        </a>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="masterstudy-single-course-stickybar__row">
                                            <a href="#"
                                                class="masterstudy-button masterstudy-button_style-primary masterstudy-button_size-sm"
                                                data-id="masterstudy-single-course-stickybar-button">
                                                <span class="masterstudy-button__title">Get this Course</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="stm-course-sidebar-actions">
                                    <div class="stm-course-wishlist-wrapper">
                                        <a href="{{ route('user.wishlist.toggle', ['id' => $course->id]) }}"
                                            class="stm-wishlist-link">
                                            @php
                                                $isInWishlist =
                                                    Auth::check() &&
                                                    Auth::user()->wishlistCourses->contains($course->id);
                                            @endphp
                                            <i class="fa{{ $isInWishlist ? 's' : 'r' }} fa-heart stm-wishlist-icon"></i>
                                            <span class="stm-wishlist-text">
                                                {{ $isInWishlist ? 'Remove from wishlist' : 'Add to wishlist' }}
                                            </span>
                                        </a>
                                    </div>

                                    <div class="stm-course-share" id="shareButton">
                                        <span class="stm-share-text"><i class="fas fa-share-square"></i> Share</span>
                                    </div>
                                </div>
                                <div class="masterstudy-single-course-price-info">
                                    {{ $course->contact_info ?? 'Liên hệ' }}
                                </div>
                                <span class="masterstudy-single-course-sleek-sidebar__sticky-block-delimiter"></span>
                            </div>
                            <ul class="masterstudy-single-course-tabs masterstudy-single-course-tabs_style-sidebar">
                                <a href="{{ route('user.index') }}">
                                    <li class="masterstudy-single-course-tabs__item" data-id="curriculum">Xem khoá học khác
                                    </li>
                                </a>
                                {{-- <li class="masterstudy-single-course-tabs__item" data-id="reviews">Reviews</li> --}}
                            </ul>
                        </div>
                    </div>
                    <!-- Main Content -->
                    <div class="masterstudy-single-course-sleek-sidebar__main">
                        <div class="masterstudy-single-course-sleek-sidebar__main-topbar">
                            <div class="masterstudy-single-course-sleek-sidebar__row">
                                <div class="masterstudy-single-course-categories">
                                    <div class="masterstudy-single-course-categories__wrapper">
                                        <div class="masterstudy-single-course-categories__container">
                                            <div class="masterstudy-single-course-categories__list">
                                                @if ($course->category)
                                                    <a class="masterstudy-single-course-categories__item"
                                                        href="{{ route('user.course', $course->category->id) }}"
                                                        target="_blank">
                                                        {{ $course->category->name }}
                                                    </a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="masterstudy-single-course-sleek-sidebar__heading">
                                <h1 class="masterstudy-single-course-title">{{ $course->title }}</h1>
                            </div>
                        </div>
                        <div class="masterstudy-single-course-sleek-sidebar__details">
                            <div class="masterstudy-single-course-details masterstudy-single-course-details_row">
                                <span class="masterstudy-single-course-details__title">Course details</span>
                                <div class="masterstudy-single-course-details__item">
                                    <span
                                        class="masterstudy-single-course-details__icon masterstudy-single-course-details__icon_lectures"></span>
                                    <span class="masterstudy-single-course-details__name">Lectures</span>
                                    <span class="masterstudy-single-course-details__separator">:</span>
                                    <span class="masterstudy-single-course-details__quantity">
                                        {{ $course->lesson }}
                                    </span>
                                </div>
                                <div class="masterstudy-single-course-details__item">
                                    <span
                                        class="masterstudy-single-course-details__icon masterstudy-single-course-details__icon_level"></span>
                                    <span class="masterstudy-single-course-details__name">Level</span>
                                    <span class="masterstudy-single-course-details__separator">:</span>
                                    <span class="masterstudy-single-course-details__quantity">
                                        {{ $course->level }}
                                    </span>
                                </div>
                                <div class="masterstudy-single-course-details__item">
                                    <span
                                        class="masterstudy-single-course-details__icon masterstudy-single-course-details__icon_access-devices"></span>
                                    <span class="masterstudy-single-course-details__name">Access on mobile and TV</span>
                                    <span class="masterstudy-single-course-details__quantity"></span>
                                </div>
                            </div>
                        </div>
                        <div class="masterstudy-single-course-tabs__content masterstudy-single-course-tabs_style-sidebar">
                            <!-- Curriculum Section -->
                            <div class="masterstudy-single-course-tabs__container" data-id="curriculum">
                                <span class="masterstudy-single-course-tabs__container-title">Curriculum</span>
                                <div class="masterstudy-curriculum-list">
                                    @if ($course->lessons->count())
                                        @foreach ($course->lessons->groupBy('chapter') as $chapterNumber => $lessons)
                                            @php
                                                // Tìm title của chương từ list_chapter
                                                $chapterTitle =
                                                    collect($chapters)->firstWhere('chapter_number', $chapterNumber)[
                                                        'chapter_title'
                                                    ] ?? 'Chưa có tiêu đề';
                                            @endphp
                                            <div
                                                class="masterstudy-curriculum-list__wrapper masterstudy-curriculum-list__wrapper_opened">
                                                <div class="masterstudy-curriculum-list__section">
                                                    <span class="masterstudy-curriculum-list__section-title">
                                                        Chương {{ $chapterNumber }} - {{ $chapterTitle }}
                                                    </span>
                                                    <span class="masterstudy-curriculum-list__toggler"></span>
                                                </div>
                                                <ul class="masterstudy-curriculum-list__materials">
                                                    @foreach ($lessons as $lesson)
                                                        <li class="masterstudy-curriculum-list__item">
                                                            <a href="{{ route('user.lessons.show', ['id' => $course->id, 'lessonId' => $lesson->id]) }}"
                                                                class="masterstudy-curriculum-list__link">
                                                                <div class="masterstudy-curriculum-list__order">
                                                                    {{ $loop->iteration }}
                                                                </div>
                                                                <img src="{{ asset('assets/user/wp-content/plugins/masterstudy-lms-learning-management-system/_core/assets/icons/lessons/video.svg') }}"
                                                                    class="masterstudy-curriculum-list__image">
                                                                <div class="masterstudy-curriculum-list__container">
                                                                    <div
                                                                        class="masterstudy-curriculum-list__container-wrapper">
                                                                        <div class="masterstudy-curriculum-list__title">
                                                                            {{ $lesson->title }}
                                                                        </div>
                                                                        <div
                                                                            class="masterstudy-curriculum-list__meta-wrapper">
                                                                            @if ($lesson->is_preview)
                                                                                <span
                                                                                    class="masterstudy-curriculum-list__preview">Preview</span>
                                                                            @endif
                                                                            <span
                                                                                class="masterstudy-curriculum-list__meta">{{ $lesson->time }}</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </a>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endforeach
                                    @else
                                        <p>No curriculum available.</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Popular Courses Section -->
                <div class="masterstudy-popular-courses">
                    <span class="masterstudy-popular-courses__title">Popular courses</span>
                    <ul class="masterstudy-popular-courses__list">
                        @foreach ($popularCourses as $popCourse)
                            <li class="masterstudy-popular-courses__item">
                                <div class="masterstudy-popular-courses__link">
                                    <a href="{{ route('user.course-detail', $popCourse->id) }}" target="_blank"
                                        class="masterstudy-popular-courses__image-wrapper">
                                        <img src="{{ asset('storage/' . $popCourse->thumbnail) }}"
                                            alt="{{ $popCourse->title }}" class="masterstudy-popular-courses__image">
                                    </a>
                                    <div class="masterstudy-popular-courses__item-meta">
                                        <a href="{{ route('user.course-detail', $popCourse->id) }}" target="_blank"
                                            class="masterstudy-popular-courses__item-title">
                                            {{ $popCourse->title }}
                                        </a>
                                        <div class="masterstudy-popular-courses__item-block">
                                            <div class="masterstudy-popular-courses__price">
                                                {{ $popCourse->price > 0 ? number_format($popCourse->price) . ' đ' : 'Free' }}
                                            </div>
                                            <div class="masterstudy-popular-courses__rating">
                                                @for ($i = 0; $i < 5; $i++)
                                                    <span
                                                        class="masterstudy-popular-courses__rating-star {{ $popCourse->rating > $i ? 'active' : '' }}"></span>
                                                @endfor
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <!-- Related Courses Section -->
                <div class="masterstudy-related-courses">
                    <span class="masterstudy-related-courses__title">Related courses</span>
                    <ul class="masterstudy-related-courses__list">
                        @php
                            $recommendedCourses = null;
                            $recommendedCourses = \App\Models\Course::where('category_id', $course->category_id)
                                ->where('id', '!=', $course->id)
                                ->inRandomOrder()
                                ->limit(5)
                                ->get();
                        @endphp
                        @foreach ($recommendedCourses as $relCourse)
                            <li class="masterstudy-related-courses__item">
                                <div class="masterstudy-related-courses__link">
                                    <a href="{{ route('user.course-detail', $relCourse->id) }}" target="_blank"
                                        class="masterstudy-related-courses__image-wrapper">
                                        <img src="{{ asset('storage/' . $relCourse->thumbnail) }}"
                                            alt="{{ $relCourse->title }}" class="masterstudy-related-courses__image">
                                    </a>
                                    <div class="masterstudy-related-courses__item-meta">
                                        <a href="{{ route('user.course-detail', $relCourse->id) }}" target="_blank"
                                            class="masterstudy-related-courses__item-title">
                                            {{ $relCourse->title }}
                                        </a>
                                        <div class="masterstudy-related-courses__item-block">
                                            <div class="masterstudy-related-courses__price">
                                                {{ $relCourse->price > 0 ? number_format($relCourse->price) . ' đ' : 'Free' }}
                                            </div>
                                            <div class="masterstudy-related-courses__rating">
                                                @for ($i = 0; $i < 5; $i++)
                                                    <span
                                                        class="masterstudy-related-courses__rating-star {{ $relCourse->rate > $i ? 'active' : '' }}"></span>
                                                @endfor
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Share Popup Overlay -->
    <div id="yt-share-overlay" class="yt-share-overlay">
        <div class="yt-share-popup">
            <div class="yt-share-header">
                <h3>Đăng bài để chia sẻ</h3>
                <button id="yt-share-close-button" class="yt-share-close-button">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round">
                        <line x1="18" y1="6" x2="6" y2="18"></line>
                        <line x1="6" y1="6" x2="18" y2="18"></line>
                    </svg>
                </button>
            </div>

            <div class="yt-share-content">
                <div class="yt-share-info">
                    <span>Chia sẻ cho bạn bè và người thân</span>
                </div>

                <div class="yt-share-divider"></div>

                <h4>Chia sẻ</h4>

                <div class="yt-share-options">
                    <div class="yt-share-option">
                        <div class="yt-share-icon yt-share-embed-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                                <polyline points="16 18 22 12 16 6"></polyline>
                                <polyline points="8 6 2 12 8 18"></polyline>
                            </svg>
                        </div>
                        <span>Nhúng</span>
                    </div>
                    <div class="yt-share-option">
                        <div class="yt-share-icon yt-share-whatsapp-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                                <path
                                    d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z">
                                </path>
                            </svg>
                        </div>
                        <span>WhatsApp</span>
                    </div>
                    <div class="yt-share-option">
                        <div class="yt-share-icon yt-share-facebook-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                                <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path>
                            </svg>
                        </div>
                        <span>Facebook</span>
                    </div>
                    <div class="yt-share-option">
                        <div class="yt-share-icon yt-share-twitter-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                                <path
                                    d="M22 4s-.7 2.1-2 3.4c1.6 10-9.4 17.3-18 11.6 2.2.1 4.4-.6 6-2C3 15.5.5 9.6 3 5c2.2 2.6 5.6 4.1 9 4-.9-4.2 4-6.6 7-3.8 1.1 0 3-1.2 3-1.2z">
                                </path>
                            </svg>
                        </div>
                        <span>X</span>
                    </div>
                    <div class="yt-share-option">
                        <div class="yt-share-icon yt-share-email-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                                <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z">
                                </path>
                                <polyline points="22,6 12,13 2,6"></polyline>
                            </svg>
                        </div>
                        <span>Gửi email</span>
                    </div>
                </div>

                <div class="yt-share-url-container">
                    <input type="text" id="yt-share-page-url" class="yt-share-url-input" readonly>
                    <button id="yt-share-copy-button" class="yt-share-copy-button">Sao chép</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('.stm-wishlist-link').on('click', function(e) {
                e.preventDefault();

                const link = $(this);
                const url = link.attr('href');
                const heartIcon = link.find('.stm-wishlist-icon');
                const textSpan = link.find('.stm-wishlist-text');

                $.ajax({
                    url: url,
                    type: 'GET',
                    success: function(response) {
                        if (response.status === 'added') {
                            // Chuyển từ trái tim rỗng sang trái tim đầy
                            heartIcon.removeClass('far').addClass('fas');
                            textSpan.text('Remove from wishlist');

                            // Hiển thị thông báo thành công nếu có
                            if (typeof toastr !== 'undefined') {
                                toastr.success('Khóa học đã được thêm vào danh sách yêu thích');
                            }
                        } else if (response.status === 'removed') {
                            // Chuyển từ trái tim đầy sang trái tim rỗng
                            heartIcon.removeClass('fas').addClass('far');
                            textSpan.text('Add to wishlist');

                            // Hiển thị thông báo thành công nếu có
                            if (typeof toastr !== 'undefined') {
                                toastr.success('Khóa học đã được xóa khỏi danh sách yêu thích');
                            }
                        }
                    },
                    error: function(xhr) {
                        if (xhr.status === 401) {
                            // Người dùng chưa đăng nhập, chuyển hướng đến trang đăng nhập
                            window.location.href = '/login';
                        } else {
                            // Xử lý lỗi khác
                            console.error('Có lỗi xảy ra:', xhr.responseText);

                            if (typeof toastr !== 'undefined') {
                                toastr.error('Đã xảy ra lỗi. Vui lòng thử lại sau.');
                            }
                        }
                    }
                });
            });

            // Xử lý nút chia sẻ - ĐÃ SỬA ĐỔI
            $('#shareButton').on('click', function(e) {
                e.preventDefault();

                // Thiết lập URL hiện tại cho input
                $('#yt-share-page-url').val(window.location.href);

                // Hiển thị popup chia sẻ
                $('#yt-share-overlay').css('display', 'flex');
                $('body').css('overflow', 'hidden'); // Ngăn cuộn trang
            });

            // Đóng popup khi nhấp vào nút đóng
            $('#yt-share-close-button').on('click', function(e) {
                e.preventDefault();
                closeSharePopup();
            });

            // Đóng khi nhấp bên ngoài popup
            $('#yt-share-overlay').on('click', function(event) {
                if (event.target === this) {
                    closeSharePopup();
                }
            });

            // Sao chép URL vào clipboard
            $('#yt-share-copy-button').on('click', function(e) {
                e.preventDefault();
                const urlInput = $('#yt-share-page-url');

                urlInput.select();
                urlInput[0].setSelectionRange(0, 99999); // Cho thiết bị di động

                try {
                    // Thực hiện lệnh sao chép
                    document.execCommand('copy');

                    // Phản hồi trực quan
                    $(this).text('Đã sao chép').addClass('yt-share-copied');

                    // Đặt lại nút sau 2 giây
                    setTimeout(function() {
                        $('#yt-share-copy-button').text('Sao chép').removeClass('yt-share-copied');
                    }, 2000);
                } catch (err) {
                    console.error('Failed to copy: ', err);

                    // Thử phương pháp thay thế cho trình duyệt hiện đại
                    if (navigator.clipboard) {
                        navigator.clipboard.writeText(urlInput.val())
                            .then(() => {
                                // Phản hồi trực quan
                                $('#yt-share-copy-button').text('Đã sao chép').addClass(
                                    'yt-share-copied');

                                // Đặt lại nút sau 2 giây
                                setTimeout(function() {
                                    $('#yt-share-copy-button').text('Sao chép').removeClass(
                                        'yt-share-copied');
                                }, 2000);
                            })
                            .catch(err => {
                                console.error('Failed to copy: ', err);
                                alert('Không thể sao chép URL. Vui lòng thử lại.');
                            });
                    } else {
                        alert('Không thể sao chép URL. Vui lòng thử lại.');
                    }
                }
            });

            // Đóng popup khi nhấn phím Escape
            $(document).on('keydown', function(event) {
                if (event.key === 'Escape' && $('#yt-share-overlay').css('display') === 'flex') {
                    closeSharePopup();
                }
            });

            // Hàm đóng popup
            function closeSharePopup() {
                $('#yt-share-overlay').css('display', 'none');
                $('body').css('overflow', ''); // Khôi phục cuộn trang
            }
        });
    </script>


@endsection
