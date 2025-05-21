@extends('admin.layouts.admin')

@section('content') 
    <div class="container">
        <div class="page-inner">
            <div class="page-header">
                <h3 class="fw-bold mb-3">Quản lý bài học</h3>
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
                        <a href="#">Bảng quản lý bài học</a>
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
                                <th>Title</th>
                                <th>Course ID</th>
                                <th>URL</th>
                                <th>Preview</th>
                                <th>Time</th>
                                <th>Chapter</th>
                                <th>Created At</th>
                                <th>Updated At</th>
                                <th class="sticky-actions">Actions</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th class="sticky-id">ID</th>
                                <th>Title</th>
                                <th>Course ID</th>
                                <th>URL</th>
                                <th>Preview</th>
                                <th>Time</th>
                                <th>Chapter</th>
                                <th>Created At</th>
                                <th>Updated At</th>
                                <th class="sticky-actions">Actions</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @forelse ($lessons as $lesson)
                                <tr>
                                    <td class="sticky-id">{{ $lesson->id }}</td>
                                    <td>{{ $lesson->title }}</td>
                                    <td>{{ $lesson->id_course }}</td>
                                    <td><a href="{{ $lesson->url }}" target="_blank">Xem bài học</a></td>
                                    <td>{{ $lesson->is_preview ? 'Yes' : 'No' }}</td>
                                    <td>{{ $lesson->time }}</td>
                                    <td>{{ $lesson->chapter }}</td>
                                    <td>{{ $lesson->created_at }}</td>
                                    <td>{{ $lesson->updated_at }}</td>
                                    <td class="text-center sticky-actions">
                                        <div class="d-flex justify-content-center gap-2">
                                            <a href="{{ route('admin.lessons.show', $lesson->id) }}" class="btn btn-warning btn-sm">
                                                <i class="fas fa-eye me-1"></i> Chi tiết
                                            </a>
                                            <a href="{{ route('admin.lessons.edit', $lesson->id) }}" class="btn btn-warning btn-sm">
                                                <i class="fas fa-edit me-1"></i> Sửa
                                            </a>
                                            <button class="btn btn-danger btn-sm delete-lesson" data-id="{{ $lesson->id }}">
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
                    Bạn có chắc chắn muốn xóa bài giảng này không?
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
        document.addEventListener('DOMContentLoaded', function () {
            let deleteLessonButtons = document.querySelectorAll('.delete-lesson');
            let closeModalBtn = document.getElementById('closeModalBtn');
            let cancelModalBtn = document.getElementById('cancelModalBtn');

            deleteLessonButtons.forEach(button => {
                button.addEventListener('click', function () {
                    let lessonId = this.getAttribute('data-id');
                    let form = document.getElementById('deleteForm');
                    form.action = '{{ url("admin/lessons") }}/' + lessonId;
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