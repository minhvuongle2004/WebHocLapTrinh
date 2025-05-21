@extends('admin.layouts.admin')

@section('content')
  <div class="container">
    <div class="page-inner">
    <div class="page-header">
      <h3 class="fw-bold mb-3">Thêm mới doanh thu</h3>
      <ul class="breadcrumbs mb-3">
      <li class="nav-home">
        <a href="{{ route('admin.dashboard') }}"><i class="icon-home"></i></a>
      </li>
      <li class="separator"><i class="icon-arrow-right"></i></li>
      <li class="nav-item"><a href="#">Incomes</a></li>
      <li class="separator"><i class="icon-arrow-right"></i></li>
      <li class="nav-item"><a href="#">Thêm mới</a></li>
      </ul>
    </div>

    @if (session('warning'))
    <div class="alert alert-warning d-flex justify-content-between align-items-center">
      <span>{{ session('warning') }}</span>
      <div>
      <a href="{{ route('admin.incomes.edit', session('id')) }}" class="btn btn-sm btn-primary">Ghi đè</a>
      <button type="button" class="btn btn-sm btn-secondary"
      onclick="this.parentElement.parentElement.style.display='none'">Bỏ qua</button>
      </div>
    </div>
  @endif

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
      <form action="{{ route('admin.incomes.store') }}" method="POST">
      @csrf
      <div class="col-md-12">
        <div class="card">
        <div class="card-header">
          <div class="card-title">Form thêm mới doanh thu</div>
        </div>

        <div class="card-body">
          <div class="row">
          <div class="col-md-6 col-lg-4">
            <button class="btn btn-primary" id="autoFillDaily" type="button">Tự động tạo theo ngày</button>
            <button class="btn btn-secondary" id="autoFillMonthly" type="button">Tự động tạo theo tháng</button>
          </div>
          </div>

          <div class="row">
          <div class="col-md-6 col-lg-4">
            <div class="form-group">
            <label for="total_buyer">Tổng số người mua</label>
            <input type="number" name="total_buyer" class="form-control" id="total_buyer" required />
            </div>

            <div class="form-group">
            <label for="total_amount">Tổng doanh thu</label>
            <input type="number" step="0.01" name="total_amount" class="form-control" id="total_amount"
              required />
            </div>

            <div class="form-group">
            <label for="type">Loại thống kê</label>
            <select name="type" id="type" class="form-select">
              <option value="day">Theo ngày</option>
              <option value="month">Theo tháng</option>
            </select>
            </div>

            <div class="form-group">
            <label for="time">Thời gian</label>
            <input type="date" name="time" class="form-control" id="time" required />
            </div>
          </div>
          </div>
        </div>
        <div class="card-action">
          <button class="btn btn-success" type="submit">Tạo doanh thu</button>
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
    let autoFillDailyBtn = document.getElementById('autoFillDaily');
    let autoFillMonthlyBtn = document.getElementById('autoFillMonthly');
    let typeSelect = document.getElementById('type');

    function fetchIncomeData(type) {
      let url = (type === 'day')
      ? "{{ route('admin.incomes.autofill.daily') }}"
      : "{{ route('admin.incomes.autofill.monthly') }}";

      fetch(url)
      .then(response => response.json())
      .then(data => {
        document.getElementById('total_buyer').value = data.total_buyer;
        document.getElementById('total_amount').value = data.total_amount;
        document.getElementById('time').value = data.time;
        typeSelect.value = type; // Tự động đổi giá trị select
      })
      .catch(error => console.error('Lỗi:', error));
    }

    if (autoFillDailyBtn) {
      autoFillDailyBtn.addEventListener('click', function () {
      fetchIncomeData('day');
      });
    }

    if (autoFillMonthlyBtn) {
      autoFillMonthlyBtn.addEventListener('click', function () {
      fetchIncomeData('month');
      });
    }
    });
  </script>

@endsection