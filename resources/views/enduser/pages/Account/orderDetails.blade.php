<div class="d-flex justify-content-between align-items-center">
    <h3 class="layout-title">Thông tin đơn hàng {{ @$order->status }}</h3>
    @if(@$order->status === "Đang xử lý")
        <button
            class="btn btn-danger cancel-order"
            data-url="{{ route("user_profile.cancelOrder", ["id" => @$order -> id]) }}"
            style="color: white !important; height: 40px; padding: 5px 10px;">
            Hủy đơn hàng
        </button>
    @endif
</div>
<table class="table">
    <tbody>
        <tr>
            <td>Mã</td>
            <td>#{{ $id }}</td>
        </tr>
        <tr>
            <td>Họ tên</td>
            <td>{{ @$user_address -> name }}</td>
        </tr>
        <tr>
            <td>Số điện thoại</td>
            <td>{{ @$user_address -> phone }}</td>
        </tr>
        <tr>
            <td>Email</td>
            <td>{{ @$user_address -> email }}</td>
        </tr>
        <tr>
            <td>Địa chỉ</td>
            <td>{{ @$user_address -> home_address }} - {{ @$user_address -> ward }} - {{ @$user_address -> district }} - {{ @$user_address -> province }}</td>
        </tr>
        <tr>
            <td>Phương thức thanh toán</td>
            <td>{{ @$order -> pay_method }}</td>
        </tr>
    </tbody>
</table>

<table class="table">
    <thead>
    <tr>
        <th class="plantmore-product-thumbnail">Ảnh</th>
        <th class="cart-product-name">Tên sản phẩm</th>
        <th class="plantmore-product-price">Giá</th>
        <th class="plantmore-product-quantity">Số lượng</th>
        <th class="plantmore-product-subtotal">Tổng</th>
    </tr>
    </thead>
    <tbody>
    @if(@$order_details)
        @foreach(@$order_details as $product_detail)
            <tr class="cart-detail">
                <td class="plantmore-product-thumbnail">
                    <img src="{{ \App\Helper\Functions::getImage("product", @$product_detail -> product_picture, "thumbnail") }}" alt=" {{ @$product_detail -> product_name }}">
                </td>
                <td class="plantmore-product-name">
                    {{ @$product_detail -> product_name }}
                </td>
                <td class="plantmore-product-price">
                    <span class="amount subtotal-text">{{ number_format(@$product_detail -> product_price) }} VND</span>
                </td>
                <td class="plantmore-product-quantity">
                    <span class="subtotal-text">{{ @$product_detail -> product_quantity }}</span>
                </td>
                <td class="product-subtotal">
                    <span class="amount">{{number_format(@$product_detail -> price_total) }} VND</span>
                </td>
            </tr>
        @endforeach
    @endif
    </tbody>
</table>
