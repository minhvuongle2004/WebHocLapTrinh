@extends('admin.layouts.admin')

@section('content')
  <div class="container">
    <div class="page-inner">
      <div class="page-header">
        <h3 class="fw-bold mb-3">Chỉnh sửa khóa học</h3>
        <ul class="breadcrumbs mb-3">
          <li class="nav-home">
            <a href="{{ route('admin.dashboard') }}"><i class="icon-home"></i></a>
          </li>
          <li class="separator"><i class="icon-arrow-right"></i></li>
          <li class="nav-item"><a href="#">Courses</a></li>
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
        <form action="{{ route('admin.courses.update', $course->id) }}" method="post" enctype="multipart/form-data">
          @csrf
          @method('PUT')
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <div class="card-title">Form chỉnh sửa khóa học</div>
              </div>

              <div class="card-body">
                <div class="row">
                  <div class="col-md-6 col-lg-4">
                    <div class="form-group">
                      <label for="title">Tên khóa học</label>
                      <input type="text" name="title" class="form-control" id="title"
                             value="{{ $course->title }}" required />
                    </div>

                    <div class="form-group">
                      <label for="level">Cấp độ</label>
                      <input type="text" name="level" class="form-control" id="level"
                             value="{{ $course->level }}" required />
                    </div>

                    <div class="form-group">
                      <label for="lesson">Số bài học</label>
                      <input type="number" name="lesson" class="form-control" id="lesson"
                             value="{{ $course->lesson }}" required />
                    </div>

                    <div class="form-group">
                      <label for="price">Giá</label>
                      <input type="number" step="0.01" name="price" class="form-control" id="price"
                             value="{{ $course->price }}" required />
                    </div>

                    <div class="form-group">
                      <label for="category">Danh mục</label>
                      <select name="category_id" class="form-select" id="category" required>
                        <option value="" disabled>Chọn danh mục...</option>
                        @foreach ($categories as $category)
                          <option value="{{ $category->id }}" {{ $course->category_id == $category->id ? 'selected' : '' }}>
                            {{ $category->category_name }}
                          </option>
                        @endforeach
                      </select>
                    </div>

                    <div class="form-group">
                      <label for="total_time_finish">Tổng thời gian hoàn thành</label>
                      <input type="text" name="total_time_finish" class="form-control" id="total_time_finish"
                             value="{{ $course->total_time_finish }}" required />
                    </div>

                    <div class="form-group">
                      <label for="finish_time">Thời gian hoàn thành</label>
                      <input type="text" name="finish_time" class="form-control" id="finish_time"
                             value="{{ $course->finish_time }}" required />
                    </div>

                    <div class="form-group">
                      <label for="expiration_date">Hạn sử dụng</label>
                      <select name="expiration_date" class="form-select" id="expiration_date" required>
                        <option value="1" {{ $course->expiration_date == 1 ? 'selected' : '' }}>1 tháng</option>
                        <option value="2" {{ $course->expiration_date == 2 ? 'selected' : '' }}>2 tháng</option>
                        <option value="3" {{ $course->expiration_date == 3 ? 'selected' : '' }}>3 tháng</option>
                        <option value="4" {{ $course->expiration_date == 4 ? 'selected' : '' }}>4 tháng</option>
                        <option value="5" {{ $course->expiration_date == 5 ? 'selected' : '' }}>5 tháng</option>
                        <option value="6" {{ $course->expiration_date == 6 ? 'selected' : '' }}>6 tháng</option>
                      </select>
                    </div>

                    <div class="form-group">
                      <label for="status">Trạng thái</label>
                      <select name="status" class="form-select" id="status">
                        <option value="Complete" {{ $course->status == 'Complete' ? 'selected' : '' }}>Hoàn thành</option>
                        <option value="Uncomplete" {{ $course->status == 'Uncomplete' ? 'selected' : '' }}>Chưa hoàn thành</option>
                      </select>
                    </div>

                    <div class="form-group">
                      <label for="is_free">Miễn phí</label>
                      <select name="is_free" class="form-select" id="is_free">
                        <option value="1" {{ $course->is_free ? 'selected' : '' }}>Có</option>
                        <option value="0" {{ !$course->is_free ? 'selected' : '' }}>Không</option>
                      </select>
                    </div>

                    <div class="form-group">
                      <label for="is_popular">Phổ biến</label>
                      <select name="is_popular" class="form-select" id="is_popular">
                        <option value="1" {{ $course->is_popular ? 'selected' : '' }}>Có</option>
                        <option value="0" {{ !$course->is_popular ? 'selected' : '' }}>Không</option>
                      </select>
                    </div>

                    <div class="form-group">
                      <label for="list_chapter">Danh sách chương</label>
                      <div id="chapter-container">
                        @php
                          $chapters = json_decode($course->list_chapter, true) ?? [];
                        @endphp
                        @foreach ($chapters as $index => $chapter)
                          <div class="chapter-item d-flex mb-2">
                            <input type="number" name="list_chapter[{{ $index }}][chapter_number]"
                                   class="form-control me-2" placeholder="Chương số"
                                   value="{{ $chapter['chapter_number'] }}" required>
                            <input type="text" name="list_chapter[{{ $index }}][chapter_title]"
                                   class="form-control me-2" placeholder="Tiêu đề chương"
                                   value="{{ $chapter['chapter_title'] }}" required>
                            <button type="button" class="btn btn-danger remove-chapter">Xóa</button>
                          </div>
                        @endforeach
                      </div>
                      <button type="button" id="add-chapter" class="btn btn-primary mt-2">Thêm chương</button>
                    </div>

                    <div class="form-group">
                      <label for="thumbnail">Ảnh khóa học</label>
                      <input type="file" name="thumbnail" class="form-control" id="thumbnail" />
                      @if($course->thumbnail)
                        <img src="{{ asset('storage/' . $course->thumbnail) }}" alt="Thumbnail" width="100" class="mt-2">
                      @endif
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

  <script>
    document.addEventListener('DOMContentLoaded', function () {
      let chapterContainer = document.getElementById('chapter-container');
      let addChapterBtn = document.getElementById('add-chapter');

      // Lấy số chapter ban đầu
      let chapterIndex = {{ count($chapters) }};

      addChapterBtn.addEventListener('click', function () {
        let newChapter = document.createElement('div');
        newChapter.classList.add('chapter-item', 'd-flex', 'mb-2');

        newChapter.innerHTML = `
          <input type="number" name="list_chapter[${chapterIndex}][chapter_number]" class="form-control me-2" placeholder="Chương số" required>
          <input type="text" name="list_chapter[${chapterIndex}][chapter_title]" class="form-control me-2" placeholder="Tiêu đề chương" required>
          <button type="button" class="btn btn-danger remove-chapter">Xóa</button>
        `;

        chapterContainer.appendChild(newChapter);
        chapterIndex++;
      });

      chapterContainer.addEventListener('click', function (e) {
        if (e.target.classList.contains('remove-chapter')) {
          e.target.parentElement.remove();
        }
      });
    });
  </script>
@endsection
