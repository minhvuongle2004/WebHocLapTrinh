@extends('admin.layouts.admin')

@section('content')
  <div class="container">
    <div class="page-inner">
      <div class="page-header">
        <h3 class="fw-bold mb-3">Chỉnh sửa đăng ký khóa học</h3>
        <ul class="breadcrumbs mb-3">
          <li class="nav-home">
            <a href="{{ route('admin.dashboard') }}"><i class="icon-home"></i></a>
          </li>
          <li class="separator"><i class="icon-arrow-right"></i></li>
          <li class="nav-item"><a href="#">Enrollments</a></li>
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
        <form action="{{ route('admin.courseEnrolled.update', $enrollment->id) }}" method="post">
          @csrf
          @method('PUT')
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <div class="card-title">Form chỉnh sửa đăng ký khóa học</div>
              </div>

              <div class="card-body">
                <div class="row">
                  <div class="col-md-6 col-lg-4">
                    <div class="form-group">
                      <label for="id_user">Người dùng</label>
                      <select name="id_user" class="form-select" id="id_user" required>
                        @foreach($users as $user)
                          <option value="{{ $user->id }}" {{ $enrollment->id_user == $user->id ? 'selected' : '' }}>{{ $user->fullname }}</option>
                      @endforeach
                      </select>
                  </div>

                  <div class="form-group">
                      <label for="id_course">Khóa học</label>
                      <select name="id_course" class="form-select" id="id_course" required>
                        @foreach($courses as $course)
                          <option value="{{ $course->id }}" {{ $enrollment->id_course == $course->id ? 'selected' : '' }}>{{ $course->title }}</option>
                      @endforeach
                      </select>
                  </div>

                  <div class="form-group">
                    <label for="title_course">Tiêu đề khóa học</label>
                    <input type="text" name="title_course" class="form-control" id="title_course" value="{{ $enrollment->title_course }}" required />
                  </div>

                  <div class="form-group">
                    <label for="status">Trạng thái</label>
                    <select name="status" class="form-select" id="status">
                      <option value="completed" {{ $enrollment->status == 'completed' ? 'selected' : '' }}>Completed</option>
                      <option value="in_progess" {{ $enrollment->status == 'in_progess' ? 'selected' : '' }}>In Progress</option>
                      <option value="expired" {{ $enrollment->status == 'expired' ? 'selected' : '' }}>Expired</option>
                    </select>
                  </div>

                  <div class="form-group">
                    <label for="progess">Tiến độ (%)</label>
                    <input type="number" step="0.01" name="progess" class="form-control" id="progess" value="{{ $enrollment->progess }}" required />
                  </div>

                  <div class="form-group">
                    <label for="expiration_date">Ngày hết hạn</label>
                    <input type="datetime-local" name="expiration_date" class="form-control" id="expiration_date" value="{{ date('Y-m-d\\TH:i', strtotime($enrollment->expiration_date)) }}" required />
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
