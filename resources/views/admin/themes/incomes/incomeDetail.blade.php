@extends('admin.layouts.admin') 

@section('content') 
    <div class="container">
        <div class="page-inner">
            <div class="page-header">
                <h3 class="fw-bold mb-3">Chi tiết doanh thu</h3>
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
                        <a href="#">Chi tiết doanh thu</a>
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
                                <td>{{ $income->id }}</td>
                            </tr>
                            <tr>
                                <td><strong>Tổng số người mua</strong></td>
                                <td>{!! noData($income->total_buyer) !!}</td>
                            </tr>
                            <tr>
                                <td><strong>Tổng doanh thu</strong></td>
                                <td>{!! noData(number_format($income->total_amount, 2)) !!}</td>
                            </tr>
                            <tr>
                                <td><strong>Thời gian</strong></td>
                                <td>{!! noData(date('d/m/Y', $income->time)) !!}</td>
                            </tr>
                            <tr>
                                <td><strong>Ngày tạo</strong></td>
                                <td>{!! noData($income->created_at->format('d/m/Y H:i')) !!}</td>
                            </tr>
                            <tr>
                                <td><strong>Ngày cập nhật</strong></td>
                                <td>{!! noData($income->updated_at ? $income->updated_at->format('d/m/Y H:i') : '--') !!}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection