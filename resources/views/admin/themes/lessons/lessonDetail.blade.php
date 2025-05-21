@extends('admin.layouts.admin')

@section('content') 
<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Thông tin bài học</h3>
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
                    <a href="#">Chi tiết bài học</a>
                </li>
            </ul>
        </div>
        <div class="row">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Trường</th>
                            <th>Dữ liệu</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            function noData($value) {
                                return empty($value) ? '<span class="badge bg-danger">No Data</span>' : $value;
                            }
                        @endphp
                        <tr>
                            <td><strong>ID</strong></td>
                            <td>{{ $lesson->id }}</td>
                        </tr>
                        <tr>
                            <td><strong>Tiêu đề</strong></td>
                            <td>{!! noData($lesson->title) !!}</td>
                        </tr>
                        <tr>
                            <td><strong>ID Khóa học</strong></td>
                            <td>{!! noData($lesson->id_course) !!}</td>
                        </tr>
                        <tr>
                            <td><strong>URL</strong></td>
                            <td>{!! empty($lesson->url) ? '<span class="badge bg-danger">No Data</span>' : '<a href="' . $lesson->url . '" target="_blank">Xem bài học</a>' !!}</td>
                        </tr>
                        <tr>
                            <td><strong>Xem trước</strong></td>
                            <td>{!! noData($lesson->is_preview ? 'Có' : 'Không') !!}</td>
                        </tr>
                        <tr>
                            <td><strong>Thời lượng</strong></td>
                            <td>{!! noData($lesson->time) !!}</td>
                        </tr>
                        <tr>
                            <td><strong>Chương</strong></td>
                            <td>{!! noData($lesson->chapter) !!}</td>
                        </tr>
                        <tr>
                            <td><strong>Ngày tạo</strong></td>
                            <td>{!! noData($lesson->created_at) !!}</td>
                        </tr>
                        <tr>
                            <td><strong>Ngày cập nhật</strong></td>
                            <td>{!! noData($lesson->updated_at) !!}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
