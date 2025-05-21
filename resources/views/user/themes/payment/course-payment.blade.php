@extends('user.layouts.home')
@section('content')
    @if (session('vnpay_success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Thành công!',
                text: '{{ session('banking_success') }}',
                confirmButtonText: 'OK'
            });
        </script>
    @endif

    @if (session('vnpay_error'))
        <script>
            Swal.fire({
                icon: 'info',
                title: 'Thông báo',
                text: '{{ session('banking_error') }}',
                confirmButtonText: 'OK'
            });
        </script>
    @endif
    <style>
        .custom-checkout-btn {
            width: 100%;
            min-height: 40px;
            background-color: #ff6600;
            color: #fff;
            padding: 15px;
            font-size: 18px;
            border: none;
            border-radius: 8px;
            transition: background-color 0.3s ease;
            font-weight: bold;
        }

        .custom-checkout-btn:hover {
            background-color: #e65c00;
            cursor: pointer;
        }
    </style>
    <div id="wrapper" class="wrapper">
        <div class="container">
            <div class="pages-template">
                <section class="page-content">
                    <div class="entry-content">
                        <div class="woocommerce">
                            <div class="woocommerce-notices-wrapper"></div>

                            <form class="woocommerce-cart-form" action="{{ route('user.payment.process') }}" method="POST">
                                @csrf
                                <table class="shop_table shop_table_responsive cart woocommerce-cart-form__contents"
                                    cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th class="product-thumbnail">Hình ảnh</th>
                                            <th class="product-name">Khóa học</th>
                                            <th class="product-price">Giá</th>
                                            <th class="product-quantity">Số lượng video</th>
                                            <th class="product-subtotal">Tạm tính</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $total = $course->price; @endphp
                                        <tr class="woocommerce-cart-form__cart-item cart_item">
                                            <td class="product-thumbnail">
                                                <img src="{{ asset('storage/' . $course->thumbnail) }}" width="300"
                                                    height="152" alt="{{ $course->title }}">
                                            </td>
                                            <td class="product-name">{{ $course->title }}</td>
                                            <td class="product-price">
                                                <span class="woocommerce-Price-amount amount"><bdi>{{ number_format($course->price) }}<span
                                                            class="woocommerce-Price-currencySymbol">₫</span></bdi></span>
                                            </td>
                                            <td class="product-quantity" style="text-align: center;">
                                                <div class="quantity">
                                                    <span class="woocommerce-Price-amount amount">
                                                        <bdi>{{ $course->lesson }} <span
                                                                class="woocommerce-Price-currencySymbol"></span></bdi>
                                                    </span>
                                                </div>
                                            </td>
                                            <td class="product-subtotal">
                                                <span class="woocommerce-Price-amount amount"><bdi>{{ number_format($course->price) }}<span
                                                            class="woocommerce-Price-currencySymbol">₫</span></bdi></span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>

                                <div class="cart-collaterals">
                                    <div class="cart_totals">
                                        <h2>Thông tin thanh toán</h2>
                                        <table cellspacing="0" class="shop_table shop_table_responsive">
                                            <tr class="cart-subtotal">
                                                <th>Tạm tính</th>
                                                <td><span class="woocommerce-Price-amount amount"><bdi>{{ number_format($total) }}<span
                                                                class="woocommerce-Price-currencySymbol">₫</span></bdi></span>
                                                </td>
                                            </tr>

                                            <tr class="order-total">
                                                <th>Mã giảm giá</th>
                                                <td><span class="woocommerce-Price-amount amount"><bdi>0<span
                                                                class="woocommerce-Price-currencySymbol">₫</span></bdi></span>
                                                </td>
                                            </tr>

                                            <tr class="order-total">
                                                <th>Tổng</th>
                                                <td><strong><span
                                                            class="woocommerce-Price-amount amount"><bdi>{{ number_format($total) }}<span
                                                                    class="woocommerce-Price-currencySymbol">₫</span></bdi></span></strong>
                                                </td>
                                            </tr>
                                        </table>

                                        <div class="payment-method" style="margin-bottom: 20px;">
                                            <label for="payment_method"><strong>Chọn phương thức thanh
                                                    toán:</strong></label>
                                            <select name="payment_method" id="payment_method" required
                                                style="width: 100%; padding: 10px; border-radius: 8px; border: 1px solid #ccc;">
                                                <option value="vn_pay">VN Pay</option>
                                                <option value="banking">Chuyển khoản ngân hàng</option>
                                            </select>
                                        </div>

                                        <div class="wc-proceed-to-checkout" style="margin-bottom: 20px">
                                            <input type="hidden" name="course_id" value="{{ $course->id }}">
                                            <button type="submit"
                                                class="checkout-button button alt wc-forward custom-checkout-btn">
                                                Tiến hành thanh toán
                                            </button>
                                        </div>

                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
@endsection
