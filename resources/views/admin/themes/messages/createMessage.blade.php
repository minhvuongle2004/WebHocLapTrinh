@extends('admin.layouts.admin')

@section('content')
  <div class="container">
    <div class="page-inner">
    <div class="page-header">
      <h3 class="fw-bold mb-3">Thêm mới tin nhắn</h3>
      <ul class="breadcrumbs mb-3">
      <li class="nav-home">
        <a href="{{ route('admin.dashboard') }}"><i class="icon-home"></i></a>
      </li>
      <li class="separator"><i class="icon-arrow-right"></i></li>
      <li class="nav-item"><a href="#">Messages</a></li>
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
      <form action="{{ route('admin.messages.store') }}" method="POST">
      @csrf
      <div class="col-md-12">
        <div class="card">
        <div class="card-header">
          <div class="card-title">Form thêm mới tin nhắn</div>
        </div>

        <div class="card-body">
          <div class="row">
          <div class="col-md-6 col-lg-4">
            <div class="form-group">
            <label for="id_sender">Người gửi</label>
            <select name="id_sender" class="form-select" id="id_sender" required>
              @foreach($users as $user)
          <option value="{{ $user->id }}">{{ $user->fullname }}</option>
        @endforeach
            </select>
            </div>

            <div class="form-group">
            <label for="id_receiver">Người nhận</label>
            <select name="id_receiver" class="form-select" id="id_receiver" required>
              @foreach($users as $user)
          <option value="{{ $user->id }}">{{ $user->fullname }}</option>
        @endforeach
            </select>
            </div>


            <div class="form-group">
            <label for="content">Nội dung</label>
            <textarea name="content" class="form-control" id="content" rows="4" required></textarea>
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
          <button class="btn btn-success" type="submit">Tạo tin nhắn</button>
          <button class="btn btn-danger" type="reset">Reset</button>
        </div>
        </div>
      </div>
      </form>
    </div>
    </div>
  </div>
@endsection