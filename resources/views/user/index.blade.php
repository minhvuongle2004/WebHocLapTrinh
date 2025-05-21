@extends('user.layouts.home')

@section('content')
    {{-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> --}}

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
                icon: 'info',
                title: 'Thông báo',
                text: '{{ session('error') }}',
                confirmButtonText: 'OK'
            });
        </script>
    @endif
    <div id="wrapper" class="wrapper">
        <div class="container">
            <div class="pages-template">
                <section class="page-content">
                    <div class="entry-content">
                        <div data-elementor-type="wp-page" data-elementor-id="55605" class="elementor elementor-55605">
                            <section
                                class="elementor-section elementor-top-section elementor-element elementor-element-a60f352 elementor-section-boxed elementor-section-height-default elementor-section-height-default"
                                data-id="a60f352" data-element_type="section">
                                <div class="elementor-container elementor-column-gap-default">
                                    <div class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-a151359"
                                        data-id="a151359" data-element_type="column">
                                        <div class="elementor-widget-wrap elementor-element-populated">
                                            <div class="elementor-element elementor-element-2069d1f elementor-widget elementor-widget-ms_lms_courses"
                                                data-id="2069d1f" data-element_type="widget"
                                                data-settings="{&quot;type&quot;:&quot;courses-grid&quot;,&quot;sort_by_cat&quot;:&quot;yes&quot;,&quot;pagination_presets&quot;:&quot;pagination-style-2&quot;,&quot;cards_to_show&quot;:80,&quot;sort_by&quot;:&quot;price_high&quot;,&quot;status_presets&quot;:&quot;status_style_2&quot;,&quot;slides_to_scroll&quot;:&quot;25%&quot;,&quot;slides_to_scroll_tablet&quot;:&quot;33.333333%&quot;,&quot;slides_to_scroll_mobile&quot;:&quot;100%&quot;,&quot;loop&quot;:&quot;true&quot;,&quot;course_card_presets&quot;:&quot;card-style-1&quot;,&quot;cards_to_show_choice&quot;:&quot;number&quot;,&quot;cards_to_show_choice_featured&quot;:&quot;number&quot;,&quot;cards_to_show_featured&quot;:4,&quot;show_progress&quot;:&quot;yes&quot;,&quot;show_divider&quot;:&quot;yes&quot;,&quot;show_rating&quot;:&quot;yes&quot;,&quot;show_price&quot;:&quot;yes&quot;,&quot;show_slots&quot;:&quot;yes&quot;,&quot;card_slot_1&quot;:&quot;current-students&quot;,&quot;card_slot_2&quot;:&quot;views&quot;,&quot;featured_position&quot;:&quot;left&quot;,&quot;status_position&quot;:&quot;right&quot;,&quot;show_popup&quot;:&quot;yes&quot;,&quot;popup_show_author_name&quot;:&quot;yes&quot;,&quot;popup_show_author_image&quot;:&quot;yes&quot;,&quot;popup_show_excerpt&quot;:&quot;yes&quot;,&quot;popup_show_slots&quot;:&quot;yes&quot;,&quot;popup_slot_1&quot;:&quot;level&quot;,&quot;popup_slot_2&quot;:&quot;lectures&quot;,&quot;popup_slot_3&quot;:&quot;duration&quot;,&quot;popup_show_wishlist&quot;:&quot;yes&quot;,&quot;popup_show_price&quot;:&quot;yes&quot;,&quot;show_instructor_label&quot;:&quot;yes&quot;,&quot;show_instructor_position&quot;:&quot;yes&quot;,&quot;show_instructor_bio&quot;:&quot;yes&quot;,&quot;course_image_size&quot;:{&quot;width&quot;:&quot;&quot;,&quot;height&quot;:&quot;&quot;}}"
                                                data-widget_type="ms_lms_courses.default">
                                                <div class="elementor-widget-container">
                                                    <div class="ms_lms_courses_grid">
                                                        <div class="ms_lms_courses_grid__title style_1">
                                                            <h2>
                                                                CHỌN LỘ TRÌNH CỦA BẠN &amp; CÙNG HỌC NHÉ! </h2>
                                                            <!-- filter -->
                                                            <div id="course-categories"
                                                                class="ms_lms_courses_grid__sorting_wrapper">
                                                                <ul class="ms_lms_courses_grid__sorting style_2">
                                                                    <li>
                                                                        <span data-id="all"
                                                                            class="ms_lms_courses_grid__sorting_button active">
                                                                            All </span>
                                                                    </li>
                                                                    <li>
                                                                        <span data-id="1"
                                                                            class="ms_lms_courses_grid__sorting_button ">
                                                                            Mới học lập trình </span>
                                                                    </li>
                                                                    <li>
                                                                        <span data-id="2"
                                                                            class="ms_lms_courses_grid__sorting_button ">
                                                                            Cơ sở dữ liệu </span>
                                                                    </li>
                                                                    <li>
                                                                        <span data-id="3"
                                                                            class="ms_lms_courses_grid__sorting_button ">
                                                                            Lập trình Web </span>
                                                                    </li>
                                                                    <li>
                                                                        <span data-id="4"
                                                                            class="ms_lms_courses_grid__sorting_button ">
                                                                            Java Backend </span>
                                                                    </li>
                                                                    <li>
                                                                        <span data-id="5"
                                                                            class="ms_lms_courses_grid__sorting_button ">
                                                                            Java Fullstack </span>
                                                                    </li>
                                                                    <li>
                                                                        <span data-id="6"
                                                                            class="ms_lms_courses_grid__sorting_button ">
                                                                            Data Science </span>
                                                                    </li>
                                                                    <li>
                                                                        <span data-id="7"
                                                                            class="ms_lms_courses_grid__sorting_button ">
                                                                            Kiến thức nền tảng </span>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                        <div class="ms_lms_courses_grid__content title_style_1">
                                                            <div class="ms_lms_courses_card_wrapper">
                                                                <div class="ms_lms_courses_card card-style-1">
                                                                    <!-- Hiển thị khóa học gợi ý -->
                                                                    @if (isset($suggestedCourses) && $suggestedCourses->count() > 0)
                                                                        <h3 class="section-title">Gợi ý cho bạn</h3>
                                                                        <div
                                                                            class="ms_lms_courses_grid__content title_style_1">
                                                                            <div class="ms_lms_courses_card_wrapper">
                                                                                <div
                                                                                    class="ms_lms_courses_card card-style-1">
                                                                                    @foreach ($suggestedCourses->take(4) as $course)
                                                                                        <div
                                                                                            class="ms_lms_courses_card_item">
                                                                                            <div
                                                                                                class="ms_lms_courses_card_item_wrapper">
                                                                                                <a href="{{ route('user.course-detail', ['id' => $course->id]) }}"
                                                                                                    class="ms_lms_courses_card_item_image_link">
                                                                                                    <img decoding="async"
                                                                                                        src="{{ asset('storage/' . $course->thumbnail) }}"
                                                                                                        class="ms_lms_courses_card_item_image"
                                                                                                        alt="{{ $course->title }}">
                                                                                                </a>
                                                                                                <div
                                                                                                    class="ms_lms_courses_card_item_info">
                                                                                                    <a href="{{ route('user.course-detail', ['id' => $course->id]) }}"
                                                                                                        class="ms_lms_courses_card_item_info_title">
                                                                                                        <h3>{{ $course->title }}
                                                                                                        </h3>
                                                                                                    </a>
                                                                                                    <div
                                                                                                        class="ms_lms_courses_card_item_info_meta">
                                                                                                        <div
                                                                                                            class="ms_lms_courses_card_item_meta_block">
                                                                                                            <i
                                                                                                                class="stmlms-members"></i>
                                                                                                            <span>{{ $course->student_enrolled }}</span>
                                                                                                        </div>
                                                                                                        <div
                                                                                                            class="ms_lms_courses_card_item_meta_block">
                                                                                                            <i
                                                                                                                class="stmlms-views"></i>
                                                                                                            <span>15634</span>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    <span
                                                                                                        class="ms_lms_courses_card_item_info_divider"></span>
                                                                                                    <div
                                                                                                        class="ms_lms_courses_card_item_info_bottom_wrapper">
                                                                                                        <div
                                                                                                            class="ms_lms_courses_card_item_info_rating">
                                                                                                            <div
                                                                                                                class="ms_lms_courses_card_item_info_rating_stars">
                                                                                                                <div
                                                                                                                    class="ms_lms_courses_card_item_info_rating_stars_filled">
                                                                                                                </div>
                                                                                                            </div>
                                                                                                            <div
                                                                                                                class="ms_lms_courses_card_item_info_rating_quantity">
                                                                                                                <span>{{ number_format($course->rate, 1) }}</span>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                        <div
                                                                                                            class="ms_lms_courses_card_item_info_price">
                                                                                                            <div
                                                                                                                class="ms_lms_courses_card_item_info_price_single">
                                                                                                                <span>{{ $course->price > 0 ? number_format($course->price, 0, ',', '.') . ' đ' : 'Miễn phí' }}</span>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    @endforeach
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    @endif

                                                                    <!-- Hiển thị khóa học ngẫu nhiên -->
                                                                    <h3 class="section-title">
                                                                        {{ Auth::check() ? 'Khóa học khác' : 'Khóa học mới nhất' }}
                                                                    </h3>
                                                                    <div class="ms_lms_courses_grid__content title_style_1">
                                                                        <div class="ms_lms_courses_card_wrapper">
                                                                            <div class="ms_lms_courses_card card-style-1">
                                                                                @foreach ($randomCourses->take(8) as $course)
                                                                                    <div class="ms_lms_courses_card_item">
                                                                                        <div
                                                                                            class="ms_lms_courses_card_item_wrapper">
                                                                                            <a href="{{ route('user.course-detail', ['id' => $course->id]) }}"
                                                                                                class="ms_lms_courses_card_item_image_link">
                                                                                                <img decoding="async"
                                                                                                    src="{{ asset('storage/' . $course->thumbnail) }}"
                                                                                                    class="ms_lms_courses_card_item_image"
                                                                                                    alt="{{ $course->title }}">
                                                                                            </a>
                                                                                            <div
                                                                                                class="ms_lms_courses_card_item_info">
                                                                                                <a href="{{ route('user.course-detail', ['id' => $course->id]) }}"
                                                                                                    class="ms_lms_courses_card_item_info_title">
                                                                                                    <h3>{{ $course->title }}
                                                                                                    </h3>
                                                                                                </a>
                                                                                                <div
                                                                                                    class="ms_lms_courses_card_item_info_meta">
                                                                                                    <div
                                                                                                        class="ms_lms_courses_card_item_meta_block">
                                                                                                        <i
                                                                                                            class="stmlms-members"></i>
                                                                                                        <span>{{ $course->student_enrolled }}</span>
                                                                                                    </div>
                                                                                                    <div
                                                                                                        class="ms_lms_courses_card_item_meta_block">
                                                                                                        <i
                                                                                                            class="stmlms-views"></i>
                                                                                                        <span>15634</span>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <span
                                                                                                    class="ms_lms_courses_card_item_info_divider"></span>
                                                                                                <div
                                                                                                    class="ms_lms_courses_card_item_info_bottom_wrapper">
                                                                                                    <div
                                                                                                        class="ms_lms_courses_card_item_info_rating">
                                                                                                        <div
                                                                                                            class="ms_lms_courses_card_item_info_rating_stars">
                                                                                                            <div
                                                                                                                class="ms_lms_courses_card_item_info_rating_stars_filled">
                                                                                                            </div>
                                                                                                        </div>
                                                                                                        <div
                                                                                                            class="ms_lms_courses_card_item_info_rating_quantity">
                                                                                                            <span>{{ number_format($course->rate, 1) }}</span>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    <div
                                                                                                        class="ms_lms_courses_card_item_info_price">
                                                                                                        <div
                                                                                                            class="ms_lms_courses_card_item_info_price_single">
                                                                                                            <span>{{ $course->price > 0 ? number_format($course->price, 0, ',', '.') . ' đ' : 'Miễn phí' }}</span>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                @endforeach
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="ms_lms_courses_grid__pagination_wrapper">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </div>
                    </div>
                </section>
            </div>
        </div>
        <script>
            document.getElementById('course-categories').addEventListener('click', function(e) {
                if (e.target && e.target.matches('.ms_lms_courses_grid__sorting_button')) {
                    const buttons = document.querySelectorAll('.ms_lms_courses_grid__sorting_button');
                    buttons.forEach(btn => btn.classList.remove('active'));
                    e.target.classList.add('active');

                    const categoryId = e.target.getAttribute('data-id');
                    console.log('Đã chọn danh mục:', categoryId);

                    // Hiển thị trạng thái đang tải
                    const courseList = document.querySelector('.ms_lms_courses_card.card-style-1');
                    if (courseList) {
                        courseList.innerHTML =
                            '<div class="loading-courses" style="width:100%; text-align:center; padding: 20px;"><p>Đang tải khóa học...</p></div>';
                    }

                    fetch(`/filter/${categoryId}`, {
                            method: 'GET',
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest',
                                'Accept': 'application/json'
                            }
                        })
                        .then(response => {
                            console.log('Phản hồi server:', response.status, response.statusText);
                            return response.json();
                        })
                        .then(data => {
                            console.log('Dữ liệu nhận được từ server:', data);

                            // Kiểm tra cấu trúc dữ liệu phản hồi
                            if (!data.success && data.message) {
                                throw new Error(data.message);
                            }

                            const courses = data.courses || [];
                            console.log('Số lượng khóa học:', courses.length);

                            // Debug thông tin từng khóa học
                            courses.forEach((course, index) => {
                                console.log(`Khóa học #${index + 1}:`, course);
                            });

                            // Tìm đúng container cho danh sách khóa học
                            if (!courseList) {
                                console.error('Không tìm thấy container khóa học. Vui lòng kiểm tra HTML.');
                                return;
                            }
                            console.log('Đã tìm thấy container khóa học:', courseList);

                            courseList.innerHTML = ''; // Xóa content cũ
                            console.log('Đã xóa nội dung cũ, bắt đầu hiển thị khóa học mới');

                            if (courses.length > 0) {
                                courses.forEach((course, index) => {
                                    // Format giá tiền
                                    const priceDisplay = course.price > 0 ?
                                        `${Number(course.price).toLocaleString('vi-VN')} đ` :
                                        'Miễn phí';

                                    // Tính toán rating stars width một cách chính xác
                                    const ratingWidth = parseFloat(course.rate || 0) * 20;

                                    console.log(
                                        `Đang hiển thị khóa học #${index + 1}: ${course.title}, Giá: ${priceDisplay}`
                                    );

                                    courseList.innerHTML += `
                        <div class="ms_lms_courses_card_item">
                            <div class="ms_lms_courses_card_item_wrapper">
                                <a href="/user/course-detail/${course.id}" class="ms_lms_courses_card_item_image_link">
                                    <img decoding="async"
                                        src="/storage/${course.thumbnail}"
                                        class="ms_lms_courses_card_item_image"
                                        alt="${course.title}">
                                </a>
                                <div class="ms_lms_courses_card_item_info">
                                    <a href="/user/course-detail/${course.id}" class="ms_lms_courses_card_item_info_title">
                                        <h3>${course.title}</h3>
                                    </a>
                                    <div class="ms_lms_courses_card_item_info_meta">
                                        <div class="ms_lms_courses_card_item_meta_block">
                                            <i class="stmlms-members"></i>
                                            <span>${course.student_enrolled || 0}</span>
                                        </div>
                                        <div class="ms_lms_courses_card_item_meta_block">
                                            <i class="stmlms-views"></i>
                                            <span>15634</span>
                                        </div>
                                    </div>
                                    <span class="ms_lms_courses_card_item_info_divider"></span>
                                    <div class="ms_lms_courses_card_item_info_bottom_wrapper">
                                        <div class="ms_lms_courses_card_item_info_rating">
                                            <div class="ms_lms_courses_card_item_info_rating_stars">
                                                <div class="ms_lms_courses_card_item_info_rating_stars_filled"
                                                    style="width: ${ratingWidth}%;">
                                                </div>
                                            </div>
                                            <div class="ms_lms_courses_card_item_info_rating_quantity">
                                                <span>${parseFloat(course.rate || 0).toFixed(1)}</span>
                                            </div>
                                        </div>
                                        <div class="ms_lms_courses_card_item_info_price">
                                            <div class="ms_lms_courses_card_item_info_price_single">
                                                <span>${priceDisplay}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>`;
                                });
                                console.log('Đã hoàn thành việc hiển thị tất cả khóa học');
                            } else {
                                console.log('Không có khóa học nào được tìm thấy cho danh mục này');
                                // Hiển thị thông báo khi không có khóa học
                                courseList.innerHTML =
                                    '<div class="no-courses-message" style="width:100%; text-align:center; padding: 20px;"><p>Không tìm thấy khóa học nào trong danh mục này.</p></div>';
                            }
                        })
                        .catch(error => {
                            console.error('Lỗi khi tải khóa học:', error);
                            // Thông báo lỗi cho người dùng
                            if (courseList) {
                                courseList.innerHTML =
                                    `<div class="error-message" style="width:100%; text-align:center; padding: 20px;"><p>Đã xảy ra lỗi khi tải khóa học: ${error.message}</p></div>`;
                            }
                        });
                }
            });

            // Thêm console.log khi trang được tải để kiểm tra event listener đã được thiết lập chưa
            console.log('Script filter đã được tải. Chờ người dùng chọn danh mục...');
        </script>
    </div>

@endsection
@include('user.chatbot_box')
