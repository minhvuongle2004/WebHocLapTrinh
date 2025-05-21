@extends('admin.layouts.admin')

@section('content') 
    <div class="container">
        <div class="page-inner">
            <div class="page-header">
                <h3 class="fw-bold mb-3">Quản lý đánh giá</h3>
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
                        <a href="#">Bảng quản lý đánh giá</a>
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
                                <th>User</th>
                                <th>Course</th>
                                <th>Content</th>
                                <th>Rate</th>
                                <th>Status</th>
                                <th>Created At</th>
                                <th>Updated At</th>
                                <th class="sticky-actions">Actions</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th class="sticky-id">ID</th>
                                <th>User</th>
                                <th>Course</th>
                                <th>Content</th>
                                <th>Rate</th>
                                <th>Status</th>
                                <th>Created At</th>
                                <th>Updated At</th>
                                <th class="sticky-actions">Actions</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @forelse ($reviews as $review)
                                <tr>
                                    <td class="sticky-id">{{ $review->id }}</td>
                                    <td>{{ $review->user->fullname ?? '--' }}</td>
                                    <td>{{ $review->course->title ?? '--' }}</td>
                                    <td>{{ Str::limit($review->content, 50) }}</td>
                                    <td>{{ number_format($review->rate, 1) ?? '0.0' }}</td>
                                    <td>{{ ucfirst($review->status) }}</td>
                                    <td>{{ $review->created_at ?? '--' }}</td>
                                    <td>{{ $review->updated_at ?? '--' }}</td>
                                    <td class="text-center sticky-actions">
                                        <div class="d-flex justify-content-center gap-2">
                                            <a href="{{ route('admin.reviews.show', $review->id) }}" class="btn btn-warning btn-sm">
                                                <i class="fas fa-eye me-1"></i> Chi tiết
                                            </a>
                                            <a href="{{ route('admin.reviews.edit', $review->id) }}" class="btn btn-warning btn-sm">
                                                <i class="fas fa-edit me-1"></i> Sửa
                                            </a>
                                            <button class="btn btn-danger btn-sm delete-review" data-id="{{ $review->id }}">
                                                <i class="fas fa-trash me-1"></i> Xóa
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9" class="text-center fw-bold text-danger">
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
                    Bạn có chắc chắn muốn xóa đánh giá này không?
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

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            let deleteReviewButtons = document.querySelectorAll('.delete-review');
            let closeModalBtn = document.getElementById('closeModalBtn');
            let cancelModalBtn = document.getElementById('cancelModalBtn');

            deleteReviewButtons.forEach(button => {
                button.addEventListener('click', function () {
                    let reviewId = this.getAttribute('data-id');
                    let form = document.getElementById('deleteForm');
                    form.action = '{{ url("admin/reviews") }}/' + reviewId;
                    $('#deleteModal').modal('show');
                });
            });

            closeModalBtn.addEventListener('click', function () {
                $('#deleteModal').modal('hide');
            });

            cancelModalBtn.addEventListener('click', function () {
                $('#deleteModal').modal('hide');
            });
        });
    </script>
@endsection
