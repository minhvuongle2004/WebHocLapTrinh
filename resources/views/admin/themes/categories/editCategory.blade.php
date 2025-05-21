@extends('admin.layouts.admin')

@section('content')
  <div class="container">
    <div class="page-inner">
    <div class="page-header">
      <h3 class="fw-bold mb-3">Chỉnh sửa danh mục</h3>
      <ul class="breadcrumbs mb-3">
        <li class="nav-home">
          <a href="{{ route('admin.dashboard') }}"><i class="icon-home"></i></a>
        </li>
        <li class="separator"><i class="icon-arrow-right"></i></li>
        <li class="nav-item"><a href="#">Danh mục</a></li>
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
      <form action="{{ route('admin.categories.update', $category->id) }}" method="post">
        @csrf
        @method('PUT')
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <div class="card-title">Form chỉnh sửa danh mục</div>
            </div>

            <div class="card-body">
              <div class="row">
                <div class="col-md-6 col-lg-4">
                  <div class="form-group">
                    <label for="category_name">Tên danh mục</label>
                    <input type="text" name="category_name" class="form-control" id="category_name" value="{{ $category->category_name }}" required />
                  </div>

                  <div class="form-group">
                    <label for="created_at">Ngày tạo</label>
                    <input type="text" name="created_at" class="form-control" id="created_at" value="{{ $category->created_at }}" disabled />
                  </div>

                  <div class="form-group">
                    <label for="updated_at">Ngày cập nhật</label>
                    <input type="text" name="updated_at" class="form-control" id="updated_at" value="{{ $category->updated_at }}" disabled />
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
