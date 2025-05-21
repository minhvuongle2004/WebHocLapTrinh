@extends('admin.layouts.admin')

@section('content') 
<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Admin Information</h3>
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
                    <a href="#">Admin Details</a>
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
                            <td>{{ $admin->id ?? '--' }}</td>
                        </tr>
                        <tr>
                            <td><strong>Username</strong></td>
                            <td>{{ $admin->username ?? '--' }}</td>
                        </tr>
                        <tr>
                            <td><strong>Created At</strong></td>
                            <td>{{ $admin->created_at ?? '--' }}</td>
                        </tr>
                        <tr>
                            <td><strong>Updated At</strong></td>
                            <td>{{ $admin->updated_at ?? '--' }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
