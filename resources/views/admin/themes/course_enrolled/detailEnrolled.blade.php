@extends('admin.layouts.admin')

@section('content') 
<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Thông tin đăng ký khóa học</h3>
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
                    <a href="#">Chi tiết đăng ký khóa học</a>
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
                            <td>{{ $enrollment->id }}</td>
                        </tr>
                        <tr>
                            <td><strong>Người dùng</strong></td>
                            <td>{!! noData($enrollment->user->fullname) !!}</td>
                        </tr>
                        <tr>
                            <td><strong>Khóa học</strong></td>
                            <td>{!! noData($enrollment->course->title) !!}</td>
                        </tr>
                        <tr>
                            <td><strong>Tiêu đề khóa học</strong></td>
                            <td>{!! noData($enrollment->title_course) !!}</td>
                        </tr>
                        <tr>
                            <td><strong>Trạng thái</strong></td>
                            <td>{!! noData(ucfirst(str_replace('_', ' ', $enrollment->status))) !!}</td>
                        </tr>
                        <tr>
                            <td><strong>Tiến độ (%)</strong></td>
                            <td>{!! noData(number_format($enrollment->progess, 2) . '%') !!}</td>
                        </tr>
                        <tr>
                            <td><strong>Ngày hết hạn</strong></td>
                            <td>{!! noData(date('d/m/Y H:i', strtotime($enrollment->expiration_date))) !!}</td>
                        </tr>
                        <tr>
                            <td><strong>Ngày tạo</strong></td>
                            <td>{!! noData($enrollment->created_at) !!}</td>
                        </tr>
                        <tr>
                            <td><strong>Ngày cập nhật</strong></td>
                            <td>{!! noData($enrollment->updated_at) !!}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
