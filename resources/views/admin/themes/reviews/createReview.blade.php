@extends('admin.layouts.admin')

@section('content')
  <div class="container">
    <div class="page-inner">
    <div class="page-header">
      <h3 class="fw-bold mb-3">Thêm mới đánh giá</h3>
      <ul class="breadcrumbs mb-3">
      <li class="nav-home">
        <a href="{{ route('admin.dashboard') }}"><i class="icon-home"></i></a>
      </li>
      <li class="separator"><i class="icon-arrow-right"></i></li>
      <li class="nav-item"><a href="#">Reviews</a></li>
      <li class="separator"><i class="icon-arrow-right"></i></li>
      <li class="nav-item"><a href="#">Thêm mới</a></li>
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
      <form action="{{ route('admin.reviews.store') }}" method="POST">
      @csrf
      <div class="col-md-12">
        <div class="card">
        <div class="card-header">
          <div class="card-title">Form thêm mới đánh giá</div>
        </div>

        <div class="card-body">
          <div class="row">
          <div class="col-md-6 col-lg-4">
            <div class="form-group">
            <label for="id_user">Người dùng</label>
            <select name="id_user" class="form-select" id="id_user" required>
              @foreach($users as $user)
          <option value="{{ $user->id }}">{{ $user->fullname }}</option>
        @endforeach
            </select>
            </div>

            <div class="form-group">
            <label for="id_course">Khóa học</label>
            <select name="id_course" class="form-select" id="id_course" required>
              @foreach($courses as $course)
          <option value="{{ $course->id }}">{{ $course->title }}</option>
        @endforeach
            </select>
            </div>

            <div class="form-group">
            <label for="content">Nội dung</label>
            <textarea name="content" class="form-control" id="content" rows="4" required></textarea>
            </div>

            <div class="form-group">
            <label for="rate">Đánh giá</label>
            <input type="number" step="0.5" min="1" max="5" name="rate" class="form-control" id="rate"
              placeholder="Nhập điểm đánh giá (1 - 5)" required />
            </div>

            <div class="form-group">
            <label for="status">Trạng thái</label>
            <select name="status" class="form-select" id="status">
              <option value="exist">Tồn tại</option>
              <option value="removed">Đã xóa</option>
            </select>
            </div>
          </div>
          </div>
        </div>
        <div class="card-action">
          <button class="btn btn-success" type="submit">Tạo đánh giá</button>
          <button class="btn btn-danger" type="reset">Reset</button>
        </div>
        </div>
      </div>
      </form>
    </div>
    </div>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', function () {
    const rateInput = document.getElementById('rate');

    rateInput.addEventListener('change', function () {
      const validValues = [1, 1.5, 2, 2.5, 3, 3.5, 4, 4.5, 5];
      if (!validValues.includes(parseFloat(rateInput.value))) {
      Swal.fire({
        icon: 'error',
        title: 'Lỗi nhập liệu!',
        text: 'Điểm đánh giá chỉ được nhập các giá trị từ 1 đến 5, cách nhau 0.5 đơn vị.',
        confirmButtonText: 'OK'
      });
      rateInput.value = ''; // Reset input nếu nhập sai
      }
    });
    });
  </script>
@endsection