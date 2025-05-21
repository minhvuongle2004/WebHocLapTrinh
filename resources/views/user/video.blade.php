@extends('user.layouts.video')

@section('content')
    <div class="v-lesson-container" id="v-lesson-container">
        <!-- Header -->
        <header class="v-header">
            <button id="v-sidebar-toggle" class="v-sidebar-toggle" aria-label="Toggle sidebar">
                <i class="fas fa-bars"></i>
            </button>
            <div class="v-header-title">
                <a href="{{ route('user.course-detail', $lesson->id_course) }}" class="v-header-back">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="m15 18-6-6 6-6" />
                    </svg>
                </a>
                <h3 class="v-header-course-title">[Video] {{ $lesson->title }}</h3>
            </div>
            <div class="v-header-actions">
                <button id="v-theme-toggle" class="v-theme-toggle" aria-label="Toggle theme">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="v-theme-icon-light">
                        <circle cx="12" cy="12" r="5" />
                        <path
                            d="M12 1v2M12 21v2M4.2 4.2l1.4 1.4M18.4 18.4l1.4 1.4M1 12h2M21 12h2M4.2 19.8l1.4-1.4M18.4 5.6l1.4-1.4" />
                    </svg>
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="v-theme-icon-dark">
                        <path d="M12 3a6 6 0 0 0 9 9 9 9 0 1 1-9-9Z" />
                    </svg>
                </button>
            </div>
        </header>

        <!-- Sidebar -->
        <aside id="v-sidebar" class="v-sidebar">
            <div class="v-sidebar-header">
                <h4 class="v-sidebar-title">{{ $course->title ?? 'Danh sách bài học' }}</h4>
                <span class="v-lesson-count">{{ count($lessons) }} bài học</span>
            </div>
            <div class="v-sidebar-content">
                <!-- Chapter organization -->
                <div class="v-chapter-list">
                    @php
                        // Lấy danh sách chapter từ list_chapter của course
                        $listChapters = [];
                        if (isset($course->list_chapter)) {
                            if (is_string($course->list_chapter)) {
                                $listChapters = json_decode($course->list_chapter, true) ?? [];
                            } elseif (is_array($course->list_chapter)) {
                                $listChapters = $course->list_chapter;
                            }
                        }

                        // Group lessons by chapter
                        $chapters = [];

                        foreach ($listChapters as $chapterIndex => $chapterInfo) {
                            $chapterNumber = $chapterInfo['chapter_number'] ?? $chapterIndex + 1;
                            $chapterTitle = $chapterInfo['chapter_title'] ?? 'Chương ' . $chapterNumber;

                            $chapters[$chapterNumber] = [
                                'title' => $chapterTitle,
                                'lessons' => [],
                                'completed' => 0,
                                'total' => 0,
                            ];
                        }

                        // Gán các bài học vào chương tương ứng
                        foreach ($lessons as $lessonItem) {
                            $chapterNumber = null;
                            // Xác định chương của bài học
                            if (isset($lessonItem->chapter) && !empty($lessonItem->chapter)) {
                                if (is_string($lessonItem->chapter)) {
                                    try {
                                        // Nếu chapter là JSON
                                        $chapterNumber = $lessonItem->chapter;
                                    } catch (\Exception $e) {
                                    }
                                } elseif (
                                    is_array($lessonItem->chapter) &&
                                    isset($lessonItem->chapter['chapter_number'])
                                ) {
                                    $chapterNumber = $lessonItem->chapter['chapter_number'];
                                }
                            }

                            // Nếu không tìm thấy chương, thử tìm theo tên chương
                            if ($chapterNumber === null) {
                                foreach ($listChapters as $chapterInfo) {
                                    if (
                                        isset($lessonItem->chapter_name) &&
                                        isset($chapterInfo['chapter_title']) &&
                                        $lessonItem->chapter_name == $chapterInfo['chapter_title']
                                    ) {
                                        $chapterNumber = $chapterInfo['chapter_number'];
                                        break;
                                    }
                                }
                            }

                            // Nếu vẫn không tìm thấy, gán vào chương đầu tiên
                            if ($chapterNumber === null || !isset($chapters[$chapterNumber])) {
                                if (count($chapters) > 0) {
                                    $chapterNumber = array_keys($chapters)[0];
                                } else {
                                    $chapterNumber = '1';
                                    $chapters[$chapterNumber] = [
                                        'title' => 'Chương 1',
                                        'lessons' => [],
                                        'completed' => 0,
                                        'total' => 0,
                                    ];
                                }
                            }

                            // Thêm bài học vào chương
                            $chapters[$chapterNumber]['lessons'][] = $lessonItem;
                            $chapters[$chapterNumber]['total']++;

                            if ($lessonItem->completed ?? false) {
                                $chapters[$chapterNumber]['completed']++;
                            }
                        }

                        // Sắp xếp các chương theo thứ tự
                        ksort($chapters);

                        // Xác định chương hiện tại của bài học đang xem
                        $currentChapterNumber = null;
                        if (isset($lesson->chapter) && !empty($lesson->chapter)) {
                            if (is_string($lesson->chapter)) {
                                try {
                                    $chapterData = json_decode($lesson->chapter, true);
                                    if (is_array($chapterData) && isset($chapterData['chapter_number'])) {
                                        $currentChapterNumber = $chapterData['chapter_number'];
                                    }
                                } catch (\Exception $e) {
                                    // Không làm gì nếu parse JSON lỗi
                                }
                            } elseif (is_array($lesson->chapter) && isset($lesson->chapter['chapter_number'])) {
                                $currentChapterNumber = $lesson->chapter['chapter_number'];
                            }
                        }

                        // Nếu không tìm thấy chương, thử tìm theo tên chương
                        if ($currentChapterNumber === null) {
                            foreach ($listChapters as $chapterInfo) {
                                if (
                                    isset($lesson->chapter_name) &&
                                    isset($chapterInfo['chapter_title']) &&
                                    $lesson->chapter_name == $chapterInfo['chapter_title']
                                ) {
                                    $currentChapterNumber = $chapterInfo['chapter_number'];
                                    break;
                                }
                            }
                        }
                    @endphp

                    @foreach ($chapters as $chapterNumber => $chapter)
                        <div class="v-chapter">
                            <button class="v-chapter-header {{ $currentChapterNumber == $chapterNumber ? 'active' : '' }}"
                                data-chapter="{{ $chapterNumber }}">
                                <span class="v-chapter-name">{{ $chapter['title'] }}</span>
                                <div class="v-chapter-info">
                                    <span
                                        class="v-chapter-progress">{{ $chapter['completed'] }}/{{ $chapter['total'] }}</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" class="v-chapter-icon">
                                        <path d="m6 9 6 6 6-6" />
                                    </svg>
                                </div>
                            </button>
                            <div class="v-chapter-content {{ $currentChapterNumber == $chapterNumber ? 'expanded' : '' }}">
                                <ul class="v-lesson-list">
                                    @foreach ($chapter['lessons'] as $item)
                                        <li class="v-lesson-item {{ $item->id == $lesson->id ? 'active' : '' }}">
                                            <a href="{{ route('user.lessons.show', ['id' => $lesson->id_course, 'lessonId' => $item->id]) }}"
                                                class="v-lesson-link">
                                                <div class="v-lesson-icon">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                        <circle cx="12" cy="12" r="10" />
                                                        <polygon points="10 8 16 12 10 16 10 8" />
                                                    </svg>
                                                </div>
                                                <div class="v-lesson-title">{{ $item->title }}</div>
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </aside>

        <!-- Main Content - Phần còn lại của tập tin -->
        <main class="v-main-content">
            <div class="v-lesson-header">
                <h1 class="v-lesson-main-title">{{ $lesson->title }}</h1>
                <div class="v-lesson-meta">
                    <span class="v-lesson-type">Video lesson</span>
                </div>
            </div>

            <div class="v-video-container">
                <div class="v-video-wrapper">
                    <iframe src="https://drive.google.com/file/d/{{ $lesson->url }}/preview" allowfullscreen
                        class="v-video-iframe"></iframe>
                    <div class="v-cover-corner"></div>
                </div>
            </div>

            <div class="v-lesson-footer">
                <div class="v-lesson-navigation">
                    @if (isset($prevLesson))
                        <a href="{{ route('user.lessons.show', ['id' => $lesson->id_course, 'lessonId' => $prevLesson->id]) }}"
                            class="v-nav-button v-prev-button">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                                <path d="m15 18-6-6 6-6" />
                            </svg>
                            Bài trước
                        </a>
                    @endif

                    @if (isset($nextLesson))
                        <a href="{{ route('user.lessons.show', ['id' => $lesson->id_course, 'lessonId' => $nextLesson->id]) }}"
                            class="v-nav-button v-next-button">
                            Bài tiếp theo
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                                <path d="m9 18 6-6-6-6" />
                            </svg>
                        </a>
                    @endif
                </div>
            </div>
        </main>
    </div>

    <style>
        :root {
            --v-primary-dark: #212529;
            --v-secondary-dark: #343a40;
            --v-text-dark: #ffffff;
            --v-text-secondary-dark: rgba(255, 255, 255, 0.7);
            --v-accent-dark: #0d6efd;
            --v-border-dark: rgba(255, 255, 255, 0.1);
            --v-hover-dark: rgba(255, 255, 255, 0.1);

            --v-primary-light: #ffffff;
            --v-secondary-light: #f8f9fa;
            --v-text-light: #212529;
            --v-text-secondary-light: #6c757d;
            --v-accent-light: #0d6efd;
            --v-border-light: #dee2e6;
            --v-hover-light: rgba(0, 0, 0, 0.05);

            --v-primary: var(--v-primary-dark);
            --v-secondary: var(--v-secondary-dark);
            --v-text: var(--v-text-dark);
            --v-text-secondary: var(--v-text-secondary-dark);
            --v-accent: var(--v-accent-dark);
            --v-border: var(--v-border-dark);
            --v-hover: var(--v-hover-dark);
        }

        .v-light-theme {
            --v-primary: var(--v-primary-light);
            --v-secondary: var(--v-secondary-light);
            --v-text: var(--v-text-light);
            --v-text-secondary: var(--v-text-secondary-light);
            --v-accent: var(--v-accent-light);
            --v-border: var(--v-border-light);
            --v-hover: var(--v-hover-light);
        }

        /* Main Container */
        .v-lesson-container {
            display: flex;
            min-height: 100vh;
            background-color: var(--v-secondary);
            position: relative;
            color: var(--v-text);
        }

        /* Header */
        .v-header {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            height: 60px;
            background-color: var(--v-primary);
            color: var(--v-text);
            display: flex;
            align-items: center;
            padding: 0 20px;
            z-index: 99;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .v-header-title {
            display: flex;
            align-items: center;
            margin-left: 30px;
        }

        .v-header-course-title {
            margin: 0;
            font-size: 18px;
            font-weight: 500;
            color: var(--v-text);
        }

        .v-header-back {
            display: flex;
            align-items: center;
            color: var(--v-text-secondary);
            margin-right: 15px;
            transition: color 0.2s;
        }

        .v-header-back:hover {
            color: var(--v-text);
        }

        .v-header-actions {
            margin-left: auto;
            display: flex;
            align-items: center;
        }

        .v-theme-toggle {
            background: none;
            border: none;
            color: var(--v-text-secondary);
            cursor: pointer;
            padding: 5px;
            border-radius: 4px;
            transition: color 0.2s, background-color 0.2s;
            position: relative;
        }

        .v-theme-toggle:hover {
            color: var(--v-text);
            background-color: var(--v-hover);
        }

        .v-theme-icon-light,
        .v-theme-icon-dark {
            display: block;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            transition: opacity 0.3s ease;
        }

        .v-theme-icon-light {
            opacity: 0;
        }

        .v-theme-icon-dark {
            opacity: 1;
        }

        .v-light-theme .v-theme-icon-light {
            opacity: 1;
        }

        .v-light-theme .v-theme-icon-dark {
            opacity: 0;
        }

        /* Sidebar Toggle Button */
        .v-sidebar-toggle {
            background-color: transparent;
            color: var(--v-text);
            border: none;
            border-radius: 4px;
            width: 36px;
            height: 36px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .v-sidebar-toggle:hover {
            background-color: var(--v-hover);
        }

        /* Sidebar */
        .v-sidebar {
            width: 280px;
            background-color: var(--v-primary);
            color: var(--v-text);
            height: 100%;
            overflow-y: auto;
            transition: all 0.3s ease;
            position: fixed;
            top: 60px;
            left: 0;
            bottom: 0;
            z-index: 100;
        }

        .v-sidebar.collapsed {
            transform: translateX(-100%);
        }

        .v-sidebar-header {
            padding: 15px 20px;
            border-bottom: 1px solid var(--v-border);
        }

        .v-sidebar-title {
            margin: 0;
            font-size: 18px;
            font-weight: 600;
            color: var(--v-text);
        }

        .v-lesson-count {
            font-size: 14px;
            color: var(--v-text-secondary);
        }

        .v-sidebar-content {
            padding: 0;
        }

        /* Chapter Styling */
        .v-chapter-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .v-chapter {
            border-bottom: 1px solid var(--v-border);
        }

        .v-chapter-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 20px;
            width: 100%;
            background-color: transparent;
            border: none;
            color: var(--v-text);
            cursor: pointer;
            text-align: left;
            transition: background-color 0.2s;
        }

        .v-chapter-header:hover {
            background-color: var(--v-hover);
        }

        .v-chapter-header.active {
            background-color: var(--v-secondary);
            font-weight: 500;
        }

        .v-chapter-name {
            font-size: 16px;
            font-weight: 500;
        }

        .v-chapter-info {
            display: flex;
            align-items: center;
        }

        .v-chapter-progress {
            font-size: 14px;
            color: var(--v-text-secondary);
            margin-right: 8px;
        }

        .v-chapter-icon {
            transition: transform 0.3s ease;
        }

        .v-chapter-header.active .v-chapter-icon {
            transform: rotate(180deg);
        }

        .v-chapter-content {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease;
        }

        .v-chapter-content.expanded {
            max-height: 1000px;
            /* Arbitrary large value */
        }

        /* Lesson List */
        .v-lesson-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .v-lesson-item {
            margin: 0;
            transition: background-color 0.2s;
        }

        .v-lesson-link {
            display: flex;
            align-items: center;
            padding: 12px 20px 12px 40px;
            /* Increased left padding for indentation */
            color: var(--v-text-secondary);
            text-decoration: none;
            transition: all 0.2s;
        }

        .v-lesson-item:hover .v-lesson-link {
            background-color: var(--v-hover);
            color: var(--v-text);
        }

        .v-lesson-item.active .v-lesson-link {
            background-color: var(--v-accent);
            color: #ffffff;
            font-weight: 500;
        }

        .v-lesson-icon {
            margin-right: 12px;
            display: flex;
            align-items: center;
            color: var(--v-text-secondary);
        }

        .v-lesson-item.active .v-lesson-icon {
            color: #ffffff;
        }

        .v-lesson-title {
            flex: 1;
            font-size: 14px;
            line-height: 1.4;
        }

        /* Main Content */
        .v-main-content {
            flex: 1;
            padding: 20px;
            margin-left: 280px;
            margin-top: 60px;
            transition: all 0.3s ease;
            min-height: calc(100vh - 60px);
            width: calc(100% - 280px);
            box-sizing: border-box;
        }

        .v-main-content.expanded {
            margin-left: 0;
            width: 100%;
        }

        .v-lesson-header {
            margin-bottom: 20px;
        }

        .v-lesson-main-title {
            font-size: 24px;
            margin: 0 0 10px 0;
            color: var(--v-text);
        }

        .v-lesson-meta {
            display: flex;
            align-items: center;
            color: var(--v-text-secondary);
            font-size: 14px;
        }

        .v-lesson-type {
            display: inline-block;
            padding: 2px 8px;
            background-color: var(--v-accent);
            color: white;
            border-radius: 4px;
            font-size: 12px;
        }

        /* Video Container */
        .v-video-container {
            margin-bottom: 20px;
            background-color: #000;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .v-video-wrapper {
            position: relative;
            padding-bottom: 56.25%;
            /* 16:9 Aspect Ratio */
            height: 0;
        }

        .v-video-iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border: none;
        }

        .v-cover-corner {
            position: absolute;
            top: 5px;
            right: 5px;
            width: 60px;
            height: 60px;
            cursor: pointer;
            background-color: transparent;
            z-index: 10;
        }

        /* Lesson Footer */
        .v-lesson-footer {
            margin-top: 30px;
        }

        /* Lesson Navigation */
        .v-lesson-navigation {
            display: flex;
            justify-content: space-between;
            margin-bottom: 30px;
        }

        .v-nav-button {
            display: inline-flex;
            align-items: center;
            background-color: var(--v-secondary);
            color: var(--v-text);
            padding: 10px 16px;
            border-radius: 4px;
            text-decoration: none;
            font-weight: 500;
            border: 1px solid var(--v-border);
            transition: all 0.2s;
        }

        .v-prev-button svg {
            margin-right: 8px;
        }

        .v-next-button svg {
            margin-left: 8px;
        }

        .v-nav-button:hover {
            background-color: var(--v-hover);
        }

        /* Additional Info */
        .v-additional-info {
            padding-top: 20px;
            border-top: 1px solid var(--v-border);
            color: var(--v-text-secondary);
        }

        .v-info-item {
            margin: 5px 0;
            font-size: 14px;
        }

        .v-youtube-link,
        .v-paypal-link {
            color: var(--v-accent);
            text-decoration: none;
        }

        .v-youtube-link:hover,
        .v-paypal-link:hover {
            text-decoration: underline;
        }

        /* Scrollbar Styling */
        ::-webkit-scrollbar {
            width: 10px;
        }

        ::-webkit-scrollbar-track {
            background-color: var(--v-primary);
        }

        ::-webkit-scrollbar-thumb {
            background-color: var(--v-secondary);
            border-radius: 5px;
            border: 2px solid var(--v-primary);
        }

        ::-webkit-scrollbar-thumb:hover {
            background-color: var(--v-accent);
        }

        /* Fix for white space on the right */
        html,
        body {
            margin: 0;
            padding: 0;
            overflow-x: hidden;
            background-color: var(--v-primary);
        }

        body {
            min-height: 100vh;
        }

        /* Ensure the container takes full width */
        .v-lesson-container {
            width: 100vw;
            max-width: 100%;
            overflow-x: hidden;
        }

        /* Responsive */
        @media (max-width: 992px) {
            .v-sidebar {
                width: 260px;
            }

            .v-main-content {
                margin-left: 260px;
                width: calc(100% - 260px);
            }
        }

        @media (max-width: 768px) {
            .v-sidebar {
                transform: translateX(-100%);
            }

            .v-sidebar.expanded {
                transform: translateX(0);
            }

            .v-main-content {
                margin-left: 0;
                padding: 15px;
                width: 100%;
            }

            .v-lesson-main-title {
                font-size: 20px;
            }
        }

        @media (max-width: 576px) {
            .v-lesson-navigation {
                flex-direction: column;
                gap: 10px;
            }

            .v-nav-button {
                width: 100%;
                justify-content: center;
            }

            .v-header-course-title {
                font-size: 16px;
                max-width: 200px;
                white-space: nowrap;
                overflow: hidden;
                text-overflow: ellipsis;
            }
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const container = document.getElementById('v-lesson-container');
            const sidebar = document.getElementById('v-sidebar');
            const mainContent = document.querySelector('.v-main-content');
            const sidebarToggle = document.getElementById('v-sidebar-toggle');
            const themeToggle = document.getElementById('v-theme-toggle');
            const chapterHeaders = document.querySelectorAll('.v-chapter-header');

            // Check if theme preference is saved in localStorage
            const savedTheme = localStorage.getItem('v-theme-preference');
            if (savedTheme === 'light') {
                container.classList.add('v-light-theme');
            }

            // Check if sidebar state is saved in localStorage
            const sidebarCollapsed = localStorage.getItem('v-sidebar-collapsed') === 'true';

            // Set initial state
            if (sidebarCollapsed) {
                sidebar.classList.add('collapsed');
                mainContent.classList.add('expanded');
            }

            // Toggle sidebar
            sidebarToggle.addEventListener('click', function() {
                sidebar.classList.toggle('collapsed');
                mainContent.classList.toggle('expanded');

                // For mobile
                sidebar.classList.toggle('expanded');

                // Save state to localStorage
                localStorage.setItem('v-sidebar-collapsed', sidebar.classList.contains('collapsed'));
            });

            // Toggle theme
            themeToggle.addEventListener('click', function() {
                container.classList.toggle('v-light-theme');

                // Save theme preference to localStorage
                const isLightTheme = container.classList.contains('v-light-theme');
                localStorage.setItem('v-theme-preference', isLightTheme ? 'light' : 'dark');

                // Update body background
                document.body.style.backgroundColor = container.classList.contains('v-light-theme') ?
                    'var(--v-primary-light)' :
                    'var(--v-primary-dark)';
            });

            // Chapter toggle functionality
            chapterHeaders.forEach(header => {
                header.addEventListener('click', function() {
                    // Toggle active state for this header
                    this.classList.toggle('active');

                    // Toggle expanded state for the content
                    const content = this.nextElementSibling;
                    content.classList.toggle('expanded');

                    // Save chapter state to localStorage
                    const chapterKey = this.getAttribute('data-chapter');
                    const isExpanded = content.classList.contains('expanded');
                    localStorage.setItem(`v-chapter-${chapterKey}`, isExpanded ? 'expanded' :
                        'collapsed');
                });

                // Check if chapter state is saved in localStorage
                const chapterKey = header.getAttribute('data-chapter');
                const chapterState = localStorage.getItem(`v-chapter-${chapterKey}`);

                if (chapterState === 'expanded') {
                    header.classList.add('active');
                    header.nextElementSibling.classList.add('expanded');
                }
            });

            // Close sidebar on mobile when clicking outside
            document.addEventListener('click', function(event) {
                const isMobile = window.innerWidth < 768;
                if (isMobile && !sidebar.contains(event.target) && event.target !== sidebarToggle) {
                    sidebar.classList.remove('expanded');
                    sidebar.classList.add('collapsed');
                    mainContent.classList.add('expanded');
                    localStorage.setItem('v-sidebar-collapsed', 'true');
                }
            });

            // Handle window resize
            window.addEventListener('resize', function() {
                if (window.innerWidth >= 768) {
                    sidebar.classList.remove('expanded');
                }
            });

            // Apply background color to document body
            document.body.style.backgroundColor = container.classList.contains('v-light-theme') ?
                'var(--v-primary-light)' :
                'var(--v-primary-dark)';
        });
    </script>
@endsection
