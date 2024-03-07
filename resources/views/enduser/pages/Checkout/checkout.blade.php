@extends("enduser.layout")
@section("head_meta")
    @include("enduser.meta", [
    "title" => "Thanh toán đơn hàng",
    "url" => Request::url(),
    ])
@stop
@section("front_content")
    <!-- breadcrumb-area start -->
    <div class="breadcrumb-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    @include("enduser.components.breadcrumb", ["currentPage" => "Thanh Toan"])
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb-area end -->

    <!-- main-content-wrap start -->
    <form id="form-address-checkout">
        <div class="main-content-wrap section-ptb checkout-page">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="coupon-area">
                        <!-- coupon-accordion start -->
                        <div class="coupon-accordion">
                            <h3>Bạn có mã giảm giá không? <span class="coupon" id="showcoupon">Nhập mã giảm giá</span></h3>
                            <div class="coupon-content" id="checkout-coupon">
                                <div class="coupon-info">
                                    <p class="checkout-coupon">
                                        <input type="text" placeholder="Mã giảm giá" name="coupon_id" id="name_coupon">
                                        <a class="btn pt-2 pb-2 click-coupon" data-url="{{ route("checkout.applyCoupon") }}"
                                            style="height: 36px;
                                            line-height: 1.4;
                                            padding: 0 6px;
                                            margin-left: 10px;">Nhập code</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <!-- coupon-accordion end -->
                    </div>
                </div>
            </div>
            <!-- checkout-details-wrapper start -->
            <div class="checkout-details-wrapper">
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <!-- billing-details-wrap start -->
                        <div class="billing-details-wrap">
                                <h3 class="shoping-checkboxt-title">Thông tin giao hàng</h3>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <p class="single-form-row">
                                            <label>Họ và tên <span class="required">*</span></label>
                                            <input type="text" name="name" id="ck-name" class="form-checkout">
                                            <span class="chkvl"></span>
                                        </p>
                                    </div>
                                    <div class="col-lg-12">
                                        <p class="single-form-row">
                                            <label>Số điện thoại <span class="required">*</span></label>
                                            <input type="text" name="phone" id="ck-phone" class="form-checkout">
                                            <span class="chkvl"></span>
                                        </p>
                                    </div>
                                    <div class="col-lg-12">
                                        <p class="single-form-row">
                                            <label>Email <span class="required">*</span></label>
                                            <input type="email" name="email" id="ck-email" class="form-checkout">
                                            <span class="chkvl"></span>
                                        </p>
                                    </div>
                                    <div class="col-lg-12">
                                        <p class="single-form-row">
                                            <label>Địa chỉ nhà <span class="required">*</span></label>
                                            <input type="text" name="home_address" id="ck-home-address" class="form-checkout">
                                            <span class="chkvl"></span>
                                        </p>
                                    </div>
                                    <div class="col-lg-12 mb-20">
                                        <div class="single-form-row">
                                            <select class="form-control form-checkout" id="select-province" name="province">
                                                <option>Tỉnh/ Thành Phố</option>
                                                @foreach($provinces as $province)
                                                    <option value="{{ $province -> id }}">{{ $province -> _name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 mb-20">
                                        <div class="single-form-row">
                                            <select class="form-control form-checkout" id="select-district" name="district">
                                                <option value="districts">Quận/ Huyện</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 mb-20">
                                        <div class="single-form-row">
                                            <select class="form-control form-checkout" id="select-ward" name="ward">
                                                <option>Phường/ Xã</option>

                                            </select>
                                        </div>
                                    </div>


                                    <div class="col-lg-12">
                                        <h3 class="shoping-checkboxt-title">Phương thức thanh toán</h3>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="form-group pure-checkbox">
                                                    <input type="radio" id="pay-cod" name="pay_method" value="cod" checked>
                                                    <label for="pay-cod">Thanh toán trực tiếp khi giao hàng</label>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="form-group pure-checkbox">
                                                    <input type="radio" id="pay-atm" name="pay_method" value="bank">
                                                    <label for="pay-atm">Thanh toán qua ATM</label>
                                                </div>
                                            </div>
                                            <div class="bank-options">
                                                    @foreach($banks as $key => $bank)
                                                        <div class="form-group pure-checkbox">
                                                            <input type="radio" id="atm-banking-{{ $key + 1 }}" name="bank" value="{{ $key + 1 }}">
                                                            <label for="atm-banking-{{ $key + 1 }}" class="bank-detail">
                                                                <img src="{{ \App\Helper\Functions::getImage("bank", $bank -> picture, "thumbnail") }}" alt="{{ $bank->name }}">
                                                                {{ $bank->name }}
                                                            </label>
                                                        </div>
                                                    @endforeach
                                                </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <p class="single-form-row m-0">
                                            <label>Ghi chú</label>
                                            <textarea name="note" class="checkout-mess" rows="2" cols="5"></textarea>
                                        </p>
                                    </div>
                                </div>
                        </div>
                        <!-- billing-details-wrap end -->
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <!-- your-order-wrapper start -->
                        <div class="your-order-wrapper">
                            <h3 class="shoping-checkboxt-title">Đơn hàng của bạn</h3>
                            <!-- your-order-wrap start-->
                            <div class="your-order-wrap">
                                <!-- your-order-table start -->
                                <div class="your-order-table table-responsive">
                                    <table>
                                        <thead>
                                        <tr>
                                            <th class="product-name th-title">Sản phẩm</th>
                                            <th class="product-total th-title">Giá</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($carts as $cart)
                                            @php
                                                $totalPrice = @$cart['subtotal'] * @$cart['quantity'];
                                                $cartTotal = @$cartTotal + @$totalPrice;
                                            @endphp
                                            <tr class="cart_item">
                                                <td class="product-name">
                                                    {{ $cart['name'] }} <strong class="product-quantity"> × {{ $cart['quantity'] }}</strong>
                                                </td>
                                                <td class="product-total">
                                                    <span class="amount">{{ number_format($totalPrice) }} VND</span>
                                                </td>
                                        @endforeach
                                        </tbody>
                                        <tfoot>
                                        <tr class="cart-subtotal">
                                            <th class="th-title">Giá tạm tính</th>
                                            <td><span class="amount" id="temporary-price">{{ number_format($cartTotal) }} VND</span></td>
                                        </tr>
                                        <tr class="cart-subtotal">
                                            <th class="th-title">Giảm giá</th>
                                            <td>- <span class="amount" id="coupon-price">0</span> VND</td>
                                        </tr>
                                        <tr class="order-total">
                                            <th class="th-title">Tổng giá</th>
                                            <td>
                                                <strong>
                                                    <span class="amount" id="order-total-price">{{ number_format($cartTotal) }} VND</span>
                                                </strong>
                                                <input type="hidden" name="price_total" id="input-total-price" value="{{ @$cartTotal }}">
                                            </td>
                                        </tr>
                                        </tfoot>
                                    </table>
                                </div>
                                <!-- your-order-table end -->

                                <!-- your-order-wrap end -->
                                <div class="payment-method">
                                    <button class="btn btn-place-order" data-href="{{ route("checkout.confirmCheckout") }}">
                                        Đặt hàng
                                    </button>
                                </div>
                                <!-- your-order-wrapper start -->

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- checkout-details-wrapper end -->
        </div>
    </div>
    </form>
    <!-- main-content-wrap end -->
@stop

<style>
    .text-noti{
        padding: 8px 15px;
        background: #F6F6F6;
        font-size: 24px;
        color: #3A3A3A;
        font-weight: 500;
        text-transform: capitalize;
    }
    .th-title{
        font-weight: bold !important;
    }

    .btn-place-order{
        background: #C89979 !important;
        color: white !important;
        border: none !important;
        width: 100%;
        transition: color .3s ease-in-out;
    }

    .btn-place-order:hover{
        background: #000000 !important;
    }
</style>
