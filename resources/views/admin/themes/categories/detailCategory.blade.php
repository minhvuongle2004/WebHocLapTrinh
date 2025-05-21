@extends('admin.layouts.admin')

@section('content') 
<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Thông tin danh mục</h3>
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
                    <a href="#">Chi tiết danh mục</a>
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
                            <td>{{ $category->id }}</td>
                        </tr>
                        <tr>
                            <td><strong>Tên danh mục</strong></td>
                            <td>{!! noData($category->category_name) !!}</td>
                        </tr>
                        <tr>
                            <td><strong>Ngày tạo</strong></td>
                            <td>{!! noData($category->created_at) !!}</td>
                        </tr>
                        <tr>
                            <td><strong>Ngày cập nhật</strong></td>
                            <td>{!! noData($category->updated_at) !!}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
