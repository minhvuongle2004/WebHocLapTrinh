@extends('admin.layouts.admin')

@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="page-header">
                <h3 class="fw-bold mb-3">Thông tin khóa học</h3>
                <ul class="breadcrumbs mb-3">
                    <li class="nav-home">
                        <a href="{{ route('admin.dashboard') }}">
                            <i class="icon-home"></i>
                        </a>
                    </li>
                    <li class="separator">
                        <i class="icon-arrow-right"></i>
                    </li>
                    <li class="nav-item">
                        <a href="#">Chi tiết khóa học</a>
                    </li>
                </ul>
            </div>
            <div class="row">
                <div class="table-responsive">
                    <table class="table table-bordered" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Trường</th>
                                <th>Dữ liệu</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                function noData($value)
                                {
                                    return empty($value) ? '<span class="badge bg-danger">No Data</span>' : $value;
                                }
                            @endphp
                            <tr>
                                <td><strong>ID</strong></td>
                                <td>{{ $course->id }}</td>
                            </tr>
                            <tr>
                                <td><strong>Tên khóa học</strong></td>
                                <td>{!! noData($course->title) !!}</td>
                            </tr>
                            <tr>
                                <td><strong>Cấp độ</strong></td>
                                <td>{!! noData($course->level) !!}</td>
                            </tr>
                            <tr>
                                <td><strong>Số bài học</strong></td>
                                <td>{!! noData($course->lesson) !!}</td>
                            </tr>
                            <tr>
                                <td><strong>Giá</strong></td>
                                <td>{!! noData(number_format($course->price, 2) . ' VNĐ') !!}</td>
                            </tr>
                            <tr>
                                <td><strong>Danh mục</strong></td>
                                <td>{!! noData($course->category->category_name ?? 'Không có danh mục') !!}</td>
                            </tr>
                            <tr>
                                <td><strong>Tổng thời gian hoàn thành</strong></td>
                                <td>{!! noData($course->total_time_finish) !!}</td>
                            </tr>
                            <tr>
                                <td><strong>Thời gian hoàn thành</strong></td>
                                <td>{!! noData($course->finish_time) !!}</td>
                            </tr>
                            <tr>
                                <td><strong>Hình ảnh</strong></td>
                                <td>
                                    @if(!empty($course->thumbnail))
                                        <img src="{{ asset('storage/' . $course->thumbnail) }}" alt="Thumbnail" width="100">
                                    @else
                                        <span class="badge bg-danger">No Data</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Hạn sử dụng</strong></td>
                                <td>{!! noData($course->expiration_date . ' tháng') !!}</td>
                            </tr>
                            <tr>
                                <td><strong>Đánh giá</strong></td>
                                <td>{!! noData($course->rate) !!}</td>
                            </tr>
                            <tr>
                                <td><strong>Số học viên đăng ký</strong></td>
                                <td>{!! noData($course->student_enrolled) !!}</td>
                            </tr>
                            <tr>
                                <td><strong>Trạng thái</strong></td>
                                <td>{!! noData(ucfirst($course->status)) !!}</td>
                            </tr>
                            <tr>
                                <td><strong>Miễn phí</strong></td>
                                <td>{!! noData($course->is_free ? 'Có' : 'Không') !!}</td>
                            </tr>
                            <tr>
                                <td><strong>Phổ biến</strong></td>
                                <td>{!! noData($course->is_popular ? 'Có' : 'Không') !!}</td>
                            </tr>
                            <tr>
                                <td><strong>Danh sách Chương</strong></td>
                                <td>
                                    @php
                                        $chapters = json_decode($course->list_chapter, true) ?? [];
                                    @endphp
                                    @if(is_array($chapters) && count($chapters) > 0)
                                        <ul class="list-group">
                                            @foreach($chapters as $chapter)
                                                <li class="list-group-item">
                                                    <strong>Chương {{ $chapter['chapter_number'] }}:</strong>
                                                    {{ $chapter['chapter_title'] }}
                                                </li>
                                            @endforeach
                                        </ul>
                                    @else
                                        <span class="badge bg-danger">No Data</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Ngày tạo</strong></td>
                                <td>{!! noData($course->created_at) !!}</td>
                            </tr>
                            <tr>
                                <td><strong>Ngày cập nhật</strong></td>
                                <td>{!! noData($course->updated_at) !!}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection