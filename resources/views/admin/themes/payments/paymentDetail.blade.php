@extends('admin.layouts.admin')

@section('content') 
<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Payment Information</h3>
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
                    <a href="#">Payment Detail</a>
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
                        <tr>
                            <td><strong>ID</strong></td>
                            <td>{{ $payment->id }}</td>
                        </tr>
                        <tr>
                            <td><strong>User</strong></td>
                            <td>{{ $payment->user->fullname ?? '--' }}</td>
                        </tr>
                        <tr>
                            <td><strong>Course</strong></td>
                            <td>{{ $payment->course->title ?? '--' }}</td>
                        </tr>
                        <tr>
                            <td><strong>Payment Method</strong></td>
                            <td>{{ ucfirst($payment->payment_method) }}</td>
                        </tr>
                        <tr>
                            <td><strong>Amount</strong></td>
                            <td>{{ number_format($payment->amount, 2) }} VNĐ</td>
                        </tr>
                        <tr>
                            <td><strong>Status</strong></td>
                            <td>{{ ucfirst($payment->status) }}</td>
                        </tr>
                        <tr>
                            <td><strong>Created At</strong></td>
                            <td>{{ $payment->created_at }}</td>
                        </tr>
                        <tr>
                            <td><strong>Updated At</strong></td>
                            <td>{{ $payment->updated_at }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection