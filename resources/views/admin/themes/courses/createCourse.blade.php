@extends('admin.layouts.admin')

@section('content')
  <div class="container">
    <div class="page-inner">
      <div class="page-header">
        <h3 class="fw-bold mb-3">Thêm mới khóa học</h3>
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
            <a href="#">Courses</a>
          </li>
          <li class="separator">
            <i class="icon-arrow-right"></i>
          </li>
          <li class="nav-item">
            <a href="#">Thêm mới khóa học</a>
          </li>
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
        <form action="{{ route('admin.courses.store') }}" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <div class="card-title">Form thêm mới khóa học</div>
              </div>

              <div class="card-body">
                <div class="row">
                  <div class="col-md-6 col-lg-4">
                    <div class="form-group">
                      <label for="title">Tên khóa học</label>
                      <input type="text" name="title" class="form-control" id="title"
                             placeholder="Nhập tên khóa học..." required />
                    </div>

                    <div class="form-group">
                      <label for="level">Cấp độ</label>
                      <input type="text" name="level" class="form-control" id="level"
                             placeholder="Nhập cấp độ..." required />
                    </div>

                    <div class="form-group">
                      <label for="lesson">Số bài học</label>
                      <input type="number" name="lesson" class="form-control" id="lesson"
                             placeholder="Nhập số bài học..." required />
                    </div>

                    <div class="form-group">
                      <label for="price">Giá</label>
                      <input type="number" step="0.01" name="price" class="form-control" id="price"
                             placeholder="Nhập giá khóa học..." required />
                    </div>

                    <div class="form-group">
                      <label for="category">Danh mục</label>
                      <select name="category_id" class="form-select" id="category" required>
                        <option value="" disabled selected>Chọn danh mục...</option>
                        @foreach ($categories as $category)
                          <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                        @endforeach
                      </select>
                    </div>

                    <div class="form-group">
                      <label for="total_time_finish">Tổng thời gian hoàn thành</label>
                      <input type="text" name="total_time_finish" class="form-control" id="total_time_finish"
                             placeholder="Nhập tổng thời gian hoàn thành..." required />
                    </div>

                    <div class="form-group">
                      <label for="finish_time">Thời gian hoàn thành</label>
                      <input type="text" name="finish_time" class="form-control" id="finish_time"
                             placeholder="Nhập thời gian hoàn thành..." required />
                    </div>

                    <div class="form-group">
                      <label for="thumbnail">Ảnh khóa học</label>
                      <input type="file" name="thumbnail" class="form-control" id="thumbnail" />
                    </div>

                    <div class="form-group">
                      <label for="expiration_date">Hạn sử dụng</label>
                      <select name="expiration_date" class="form-select" id="expiration_date" required>
                        <option value="1">1 tháng</option>
                        <option value="2">2 tháng</option>
                        <option value="3">3 tháng</option>
                        <option value="4">4 tháng</option>
                        <option value="5">5 tháng</option>
                        <option value="6">6 tháng</option>
                      </select>
                    </div>

                    <div class="form-group">
                      <label for="status">Trạng thái</label>
                      <select name="status" class="form-select" id="status">
                        <option value="Complete">Hoàn thành</option>
                        <option value="Uncomplete">Chưa hoàn thành</option>
                      </select>
                    </div>

                    <div class="form-group">
                      <label for="is_free">Miễn phí</label>
                      <select name="is_free" class="form-select" id="is_free">
                        <option value="1">Có</option>
                        <option value="0">Không</option>
                      </select>
                    </div>

                    <div class="form-group">
                      <label for="is_popular">Phổ biến</label>
                      <select name="is_popular" class="form-select" id="is_popular">
                        <option value="1">Có</option>
                        <option value="0">Không</option>
                      </select>
                    </div>

                    <!-- List Chapter Input -->
                    <div class="form-group">
                      <label for="list_chapter">Danh sách chương</label>
                      <div id="chapter-list">
                        <!-- Mặc định có 1 dòng chương -->
                        <div class="chapter-item d-flex mb-2">
                          <input type="text" name="list_chapter[0][chapter_title]"
                                 class="form-control me-2" placeholder="Nhập tiêu đề chương" required>
                          <input type="number" name="list_chapter[0][chapter_number]"
                                 class="form-control me-2" placeholder="Chương số" min="1" required>
                          <button type="button" class="btn btn-danger btn-sm remove-chapter">X</button>
                        </div>
                      </div>
                      <button type="button" class="btn btn-primary btn-sm mt-2" onclick="addChapter()">Thêm chương</button>
                    </div>

                  </div>
                </div>
              </div>

              <div class="card-action">
                <button class="btn btn-success" type="submit">Tạo khóa học</button>
                <button class="btn btn-danger" type="reset">Reset</button>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>

  <script>
    let chapterIndex = 1; // Dùng để tạo index động cho các chương mới

    function addChapter() {
      let container = document.getElementById('chapter-list');
      let div = document.createElement('div');
      div.className = 'chapter-item d-flex mb-2';
      div.innerHTML = `
        <input type="text" name="list_chapter[${chapterIndex}][chapter_title]" class="form-control me-2" placeholder="Nhập tiêu đề chương" required>
        <input type="number" name="list_chapter[${chapterIndex}][chapter_number]" class="form-control me-2" placeholder="Chương số" min="1" required>
        <button type="button" class="btn btn-danger btn-sm remove-chapter">X</button>
      `;
      container.appendChild(div);
      chapterIndex++;
    }

    document.addEventListener('click', function (event) {
      if (event.target.classList.contains('remove-chapter')) {
        event.target.closest('.chapter-item').remove();
      }
    });
  </script>
@endsection
