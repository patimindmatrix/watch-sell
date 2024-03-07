@extends("enduser.layout")
@section("front_content")
    <!-- breadcrumb-area start -->
    <div class="breadcrumb-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    @include("enduser.components.breadcrumb", ["currentPage" => "Thanh toán thành công"])
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb-area end -->

    <!-- main-content-wrap start -->
    <div class="checkout-layout" style="padding: 20px 0;">
        <div class="container">
            <div class="cart-layout-wrapper">
                <h3>Đặt hàng thành công</h3>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="box_order_general mb-3">
                            <div class="item">
                                <span class="title_order">Mã:</span>
                                <span>{{ @$order -> id }}</span>
                            </div>
                            <div class="item">
                                <span class="title_order">Thời gian:</span>
                                <span>{{ date_format(@$order -> updated_at, "d/m/Y H:i:s") }}</span>
                            </div>
                        </div>
                        <div class="table-content">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <td>Mã</td>
                                        <td>Hình ảnh</td>
                                        <td>Tên</td>
                                        <td>Giá</td>
                                        <td>Số lượng</td>
                                        <td>Tổng</td>
                                        <td>Trạng thái</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($order_details as $order_detail)
                                        <tr>
                                            <td>{{ @$order_detail -> id }}</td>
                                            <td>
                                                <img src="{{ \App\Helper\Functions::getImage("product", @$order_detail -> product_picture, "thumbnail") }}" alt="">
                                            </td>
                                            <td>{{ @$order_detail -> product_name }}</td>
                                            <td>{{ number_format(@$order_detail -> product_price) }} VND</td>
                                            <td>{{ @$order_detail -> product_quantity }}</td>
                                            <td>{{ number_format(@$order_detail -> price_total) }} VND</td>
                                            <td>
                                                <span class="badge badge-success">
                                                    {{ @$order_detail -> status }}
                                                </span>
                                            </td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td colspan="6"></td>
                                        <td>
                                            <p><a href="#neo-order" class="btn_now_checkout btn">Thanh toán ngay</a></p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="6">
                                            <h6>Tổng</h6>
                                        </td>
                                        <td><span>{{ number_format(@$order -> price_total) }} VND</span></td>
                                    </tr>
                                </tbody>
                            </table>
                            @if(@$order -> pay_method == "bank")
                                <h5 id="neo-order" class="mt-3">Danh sách tài khoản ngân hàng</h5>
                                <div class="note-order note">
                                    <h6>Hướng dẫn thanh toán:</h6>
                                    <p>Nội dung chuyển khoản:
                                        <b>DK {{ @$order -> id }}</b>
                                    </p>
                                </div>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Ngân hàng</th>
                                            <th>Chủ tài khoản</th>
                                            <th>Số tài khoản</th>
                                            <th>Chi nhánh</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($banks as $bank)
                                        <tr>
                                            <td>
                                                <img src="{{ \App\Helper\Functions::getImage("bank", @$bank -> picture, "thumbnail") }}" alt="{{ $bank -> name }}" style="width: 150px">
                                                <span style="color: #333333; font-size: 14px">{{ @$bank -> name }}</span>
                                            </td>
                                            <td>{{ @$bank -> account_name }}</td>
                                            <td>{{ @$bank -> account_number }}</td>
                                            <td>{{ @$bank -> branch }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            @else
                                <h5 id="neo-order" class="mt-3">Chúng tôi sẽ chủ động liên hệ với bạn sau ( 2 - 5 ngày làm việc ), Xin cảm ơn !!!</h5>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- main-content-wrap end -->
@stop

<style>
    .notification-wrapper{
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        border: 1px solid #ccc;
        padding: 50px 0;
    }

    .notification-wrapper i {
        display: block;
        color: #cccccc;
        font-size: 150px;
        pointer-events: none;
        opacity: .8;
        margin-bottom: 30px;
    }

    .cart-notification{
        font-size: 16px;
        color: #c89979;
        opacity: .9;
        pointer-events: none;
    }
    .btn-back{
        padding: 8px;
        text-align: center;
        border: 1px solid #ccc;
        background: #C89979;
        border-radius: 10px;
        width: 220px;
        font-size: 16px;
        color: #ffffff;
        transition: all .3s ease-in-out;
    }

    .btn-back:hover{
        background: #333333;
        color: #ffffff;
    }
</style>
