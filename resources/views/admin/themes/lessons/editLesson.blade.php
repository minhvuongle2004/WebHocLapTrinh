@extends('admin.layouts.admin')

@section('content')
  <div class="container">
    <div class="page-inner">
    <div class="page-header">
      <h3 class="fw-bold mb-3">Chỉnh sửa bài học</h3>
      <ul class="breadcrumbs mb-3">
        <li class="nav-home">
          <a href="{{ route('admin.dashboard') }}"><i class="icon-home"></i></a>
        </li>
        <li class="separator"><i class="icon-arrow-right"></i></li>
        <li class="nav-item"><a href="#">Lessons</a></li>
        <li class="separator"><i class="icon-arrow-right"></i></li>
        <li class="nav-item"><a href="#">Chỉnh sửa</a></li>
      </ul>
    </div>

    @if ($errors->any())
    <script>
      document.addEventListener('DOMContentLoaded', function () {
        let errorMessages = "";
        @foreach ($errors->all() as $error)
            errorMessages += "{{ $error }}\n";
        @endforeach
        Swal.fire({
          icon: 'error',
          title: 'Lỗi nhập liệu!',
          text: errorMessages,
          confirmButtonText: 'OK'
        });
      });
    </script>
    @endif

    <div class="row">
      <form action="{{ route('admin.lessons.update', $lesson->id) }}" method="post">
        @csrf
        @method('PUT')
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <div class="card-title">Form chỉnh sửa bài học</div>
            </div>

            <div class="card-body">
              <div class="row">
                <div class="col-md-6 col-lg-4">
                  <div class="form-group">
                    <label for="title">Tiêu đề</label>
                    <input type="text" name="title" class="form-control" id="title" value="{{ $lesson->title }}" required />
                  </div>

                  <div class="form-group">
                    <label for="id_course">ID Khóa học</label>
                    <input type="number" name="id_course" class="form-control" id="id_course" value="{{ $lesson->id_course }}" required />
                  </div>

                  <div class="form-group">
                    <label for="url">URL</label>
                    <input type="text" name="url" class="form-control" id="url" value="{{ $lesson->url }}" required />
                  </div>

                  <div class="form-group">
                    <label for="is_preview">Xem trước</label>
                    <select name="is_preview" class="form-select" id="is_preview">
                      <option value="1" {{ $lesson->is_preview ? 'selected' : '' }}>Có</option>
                      <option value="0" {{ !$lesson->is_preview ? 'selected' : '' }}>Không</option>
                    </select>
                  </div>

                  <div class="form-group">
                    <label for="time">Thời lượng</label>
                    <input type="text" name="time" class="form-control" id="time" value="{{ $lesson->time }}" required />
                  </div>

                  <div class="form-group">
                    <label for="chapter">Chương</label>
                    <input type="text" name="chapter" class="form-control" id="chapter" value="{{ $lesson->chapter }}" required />
                  </div>
                </div>
              </div>
            </div>
            <div class="card-action">
              <button class="btn btn-primary" type="submit">Cập nhật</button>
              <button class="btn btn-danger" type="reset">Reset</button>
            </div>
          </div>
        </div>
      </form>
    </div>
    </div>
  </div>
@endsection
