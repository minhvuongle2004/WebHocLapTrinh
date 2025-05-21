@extends('admin.layouts.admin')

@section('content') 
<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">User Information</h3>
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
                    <a href="#">User Details</a>
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
                            <td>{{ $user->id ?? '--' }}</td>
                        </tr>
                        <tr>
                            <td><strong>Email</strong></td>
                            <td>{{ $user->email ?? '--' }}</td>
                        </tr>
                        <tr>
                            <td><strong>Full Name</strong></td>
                            <td>{{ $user->fullname ?? '--' }}</td>
                        </tr>
                        <tr>
                            <td><strong>Display Name</strong></td>
                            <td>{{ $user->displayname ?? '--' }}</td>
                        </tr>
                        <tr>
                            <td><strong>Username</strong></td>
                            <td>{{ $user->username ?? '--' }}</td>
                        </tr>
                        <tr>
                            <td><strong>Phone</strong></td>
                            <td>
                                @if (!empty($user->phone))
                                    {{ $user->phone }}
                                @else
                                    <span class="badge bg-danger">No data</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Avatar</strong></td>
                            <td>
                                @if (!empty($user->avatar))
                                    <img src="{{ asset('storage/'. $user->avatar) }}" alt="Avatar" width="50">
                                @else
                                    <span class="badge bg-danger">No data</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Created At</strong></td>
                            <td>{{ $user->created_at ?? '--' }}</td>
                        </tr>
                        <tr>
                            <td><strong>Updated At</strong></td>
                            <td>{{ $user->updated_at ?? '--' }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection