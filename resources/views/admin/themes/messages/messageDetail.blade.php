@extends('admin.layouts.admin') 

@section('content') 
    <div class="container">
        <div class="page-inner">
            <div class="page-header">
                <h3 class="fw-bold mb-3">Chi tiết tin nhắn</h3>
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
                        <a href="#">Chi tiết tin nhắn</a>
                    </li>
                </ul>
            </div>
            @php
                function noData($value)
                {
                    return empty($value) ? '<span class="badge bg-danger">No Data</span>' : $value;
                }
            @endphp
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
                            <tr>
                                <td><strong>ID</strong></td>
                                <td>{{ $message->id }}</td>
                            </tr>
                            <tr>
                                <td><strong>Người gửi</strong></td>
                                <td>{!! noData($message->sender->fullname) !!}</td>
                            </tr>
                            <tr>
                                <td><strong>Người nhận</strong></td>
                                <td>{!! noData($message->receiver->fullname) !!}</td>
                            </tr>

                            <tr>
                                <td><strong>Nội dung</strong></td>
                                <td>{!! noData($message->content) !!}</td>
                            </tr>
                            <tr>
                                <td><strong>Trạng thái</strong></td>
                                <td>{!! noData(ucfirst($message->status)) !!}</td>
                            </tr>
                            <tr>
                                <td><strong>Ngày tạo</strong></td>
                                <td>{!! noData($message->created_at) !!}</td>
                            </tr>
                            <tr>
                                <td><strong>Ngày cập nhật</strong></td>
                                <td>{!! noData($message->updated_at) !!}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection