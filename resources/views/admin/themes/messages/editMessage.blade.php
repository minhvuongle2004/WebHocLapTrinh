@extends('admin.layouts.admin')

@section('content')
  <div class="container">
    <div class="page-inner">
    <div class="page-header">
      <h3 class="fw-bold mb-3">Chỉnh sửa tin nhắn</h3>
      <ul class="breadcrumbs mb-3">
      <li class="nav-home">
        <a href="{{ route('admin.dashboard') }}"><i class="icon-home"></i></a>
      </li>
      <li class="separator"><i class="icon-arrow-right"></i></li>
      <li class="nav-item"><a href="#">Messages</a></li>
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
      <form action="{{ route('admin.messages.update', $message->id) }}" method="post">
      @csrf
      @method('PUT')
      <div class="col-md-12">
        <div class="card">
        <div class="card-header">
          <div class="card-title">Form chỉnh sửa tin nhắn</div>
        </div>

        <div class="card-body">
          <div class="row">
          <div class="col-md-6 col-lg-4">
            <div class="form-group">
            <label for="sender">Người gửi</label>
            <input type="text" class="form-control" id="sender" value="{{ $message->sender->fullname }}"
              readonly />
            <input type="hidden" name="id_sender" value="{{ $message->sender->id }}" />
            </div>

            <div class="form-group">
            <label for="receiver">Người nhận</label>
            <input type="text" class="form-control" id="receiver" value="{{ $message->receiver->fullname }}"
              readonly />
            <input type="hidden" name="id_receiver" value="{{ $message->receiver->id }}" />
            </div>

            <div class="form-group">
            <label for="content">Nội dung</label>
            <textarea name="content" class="form-control" id="content" rows="4"
              required>{{ $message->content }}</textarea>
            </div>

            <div class="form-group">
            <label for="status">Trạng thái</label>
            <select name="status" class="form-select" id="status">
              <option value="exist" {{ $message->status == 'exist' ? 'selected' : '' }}>Tồn tại</option>
              <option value="removed" {{ $message->status == 'removed' ? 'selected' : '' }}>Đã xóa</option>
            </select>
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