@extends('admin.layouts.admin')

@section('content') 
    <div class="container">
        <div class="page-inner">
            <div class="page-header">
                <h3 class="fw-bold mb-3">Quản lý doanh thu</h3>
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
                        <a href="#">Bảng quản lý doanh thu</a>
                    </li>
                </ul>
            </div>

            @if(session('success'))
                <script>
                    document.addEventListener('DOMContentLoaded', function () {
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
                                <th class="sticky-id">ID</th>
                                <th>Tổng người mua</th>
                                <th>Tổng doanh thu</th>
                                <th>Thời gian</th>
                                <th>Loại thống kê</th>
                                <th>Ngày tạo</th>
                                <th>Ngày cập nhật</th>
                                <th class="sticky-actions">Actions</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th class="sticky-id">ID</th>
                                <th>Tổng người mua</th>
                                <th>Tổng doanh thu</th>
                                <th>Thời gian</th>
                                <th>Loại thống kê</th>
                                <th>Ngày tạo</th>
                                <th>Ngày cập nhật</th>
                                <th class="sticky-actions">Actions</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @forelse ($incomes as $income)
                                <tr>
                                    <td class="sticky-id">{{ $income->id }}</td>
                                    <td>{{ $income->total_buyer }}</td>
                                    <td>{{ number_format($income->total_amount, 2) }}</td>
                                    <td>{{ $income->time }}</td>
                                    <td>{{ $income->type }}</td>
                                    <td>{{ $income->created_at->format('d/m/Y H:i') }}</td>
                                    <td>{{ $income->updated_at ? $income->updated_at->format('d/m/Y') : '--' }}</td>
                                    <td>
                                        <a href="{{ route('admin.incomes.show', $income->id) }}" class="btn btn-warning btn-sm">
                                            <i class="fas fa-eye me-1"></i> Chi tiết
                                        </a>
                                        <a href="{{ route('admin.incomes.edit', $income->id) }}" class="btn btn-warning btn-sm">
                                            <i class="fas fa-edit me-1"></i> Sửa
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center fw-bold text-danger">
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

    {{-- Modal xóa doanh thu --}}
    <div class="modal" id="deleteModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Xác nhận xóa</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Bạn chắc chắn muốn xóa bản ghi này không?
                </div>
                <div class="modal-footer">
                    <form id="deleteForm" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Xóa</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            $('.btn-delete').on('click', function () {
                let incomeId = $(this).data('id');
                $('#deleteForm').attr('action', '{{ url("admin/incomes") }}/' + incomeId);
                $('#deleteModal').modal('show');
            });
        });
    </script>
@endsection
