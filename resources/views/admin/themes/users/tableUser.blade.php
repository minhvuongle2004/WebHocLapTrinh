@extends('admin.layouts.admin')

@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="page-header">
                <h3 class="fw-bold mb-3">Quản lý người dùng</h3>
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
                        <a href="#">Bảng người dùng</a>
                    </li>
                </ul>
            </div>

            <!-- Sweet Alert -->
            @if (session('success'))
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        Swal.fire({
                            icon: 'success',
                            title: 'Thành công!',
                            text: '{{ session('success') }}',
                            confirmButtonText: 'OK'
                        });
                    });
                </script>
            @endif

            <div class="row table-row">
                <div class="table-container">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th class="sticky-id">Id</th>
                                <th>Email</th>
                                <th>Full Name</th>
                                <th>Display Name</th>
                                <th>Username</th>
                                <th>Phone</th>
                                <th>Avatar</th>
                                <th>Created At</th>
                                <th>Updated At</th>
                                <th class="sticky-actions">Actions</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th class="sticky-id">Id</th>
                                <th>Email</th>
                                <th>Full Name</th>
                                <th>Display Name</th>
                                <th>Username</th>
                                <th>Phone</th>
                                <th>Avatar</th>
                                <th>Created At</th>
                                <th>Updated At</th>
                                <th class="sticky-actions">Actions</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @forelse ($users as $user)
                                <tr>
                                    <td class="sticky-id">{{ $user->id }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->fullname }}</td>
                                    <td>{{ $user->displayname }}</td>
                                    <td>{{ $user->username }}</td>
                                    <td>{{ $user->phone ?? '--' }}</td>
                                    <td>
                                        @if ($user->avatar)
                                            <img src="{{ asset('storage/' . $user->avatar) }}" alt="Avatar"
                                                style="width: 50px; height: 50px; object-fit: cover;">
                                        @else
                                            --
                                        @endif
                                    </td>
                                    <td>{{ $user->created_at ?? '--' }}</td>
                                    <td>{{ $user->updated_at ?? '--' }}</td>
                                    <td class="text-center sticky-actions">
                                        <div class="d-flex justify-content-center gap-2">
                                            <a href="{{ route('admin.users.show', ['id' => $user->id]) }}"
                                                class="btn btn-warning btn-sm w-100 d-flex align-items-center justify-content-center">
                                                <i class="fas fa-user me-1"></i> Chi tiết
                                            </a>

                                            <a href="{{ route('admin.users.edit', ['id' => $user->id]) }}"
                                                class="btn btn-warning btn-sm w-100 d-flex align-items-center justify-content-center">
                                                <i class="fas fa-edit me-1"></i> Sửa
                                            </a>
                                            <button
                                                class="btn btn-danger btn-sm w-100 d-flex align-items-center justify-content-center delete-user"
                                                data-id="{{ $user->id }}">
                                                <i class="fas fa-trash me-1"></i> Xóa
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="10" class="text-center fw-bold text-danger">
                                        Không có bản ghi nào được tìm thấy
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Xác nhận Xóa -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Xác nhận xóa</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="closeModalBtn">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Bạn có chắc chắn muốn xóa giao dịch thanh toán này không?
                </div>
                <div class="modal-footer">
                    <form id="deleteForm" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Xóa</button>
                    </form>
                    <button type="button" class="btn btn-secondary" id="cancelModalBtn">Hủy</button>
                </div>
            </div>
        </div>
    </div>

    {{-- Script xử lý Xóa --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let deleteUserButtons = document.querySelectorAll('.delete-user');
            let closeModalBtn = document.getElementById('closeModalBtn');
            let cancelModalBtn = document.getElementById('cancelModalBtn');

            deleteUserButtons.forEach(button => {
                button.addEventListener('click', function() {
                    let userId = this.getAttribute('data-id');
                    let form = document.getElementById('deleteForm');
                    form.action = '{{ url('admin/users') }}/' + userId;
                    $('#deleteModal').modal('show');
                });
            });

            closeModalBtn.addEventListener('click', function() {
                $('#deleteModal').modal('hide');
            });

            cancelModalBtn.addEventListener('click', function() {
                $('#deleteModal').modal('hide');
            });
        });
    </script>
@endsection
