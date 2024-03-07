<form action="#" class="cart-table" id="cart-table" data-url="{{ route("cart.deleteProduct") }}">
    @if(!empty($carts))
    <div class="table-content table-responsive" data-url="{{ route("cart.updateCart") }}">
        <table class="table">
            <thead>
            <tr>
                <th class="plantmore-product-thumbnail">Ảnh</th>
                <th class="cart-product-name">Tên</th>
                <th class="plantmore-product-price">Giá</th>
                <th class="plantmore-product-quantity">Số lượng</th>
                <th class="plantmore-product-subtotal">Tổng tiền</th>
                <th class="plantmore-product-remove">Xóa</th>
            </tr>
            </thead>
            <tbody>
            @foreach($carts as $item)
                @php
                    $totalPrice = $item['subtotal'] * $item['quantity'];
                    $cartTotal = @$cartTotal + $totalPrice;
                @endphp
                <tr class="cart-detail">
                    <input type="hidden" name="id" class="id-product" value="{{ @$item["id"] }}">
                    <td class="plantmore-product-thumbnail">
                        <a href="{{ route("shop.productDetail", ["slug" => @$item['slug']]) }}">
                            <img src="{{ \App\Helper\Functions::getImage("product", @$item['picture'], "thumbnail") }}" alt="{{ $item['name'] }}">
                        </a>
                    </td>
                    <td class="plantmore-product-name">
                        <a href="{{ route("shop.productDetail", ["slug" => @$item['slug']]) }}">{{ @$item['name'] }}</a>
                    </td>
                    <td class="plantmore-product-price original-price">
                        <span class="amount subtotal-text">{{ number_format(@$item['subtotal']) }}</span>
                        <span>VND</span>
                    </td>
                    <td class="plantmore-product-quantity">
                        <input
                            type="text" min="0" maxlength="3"
                            class="input-text quantity input-quantity"
                            name="quantity" value="{{ @$item['quantity'] }}"
                            data-check-cart="false"
                            data-url="{{ route('cart.checkProductQuantity', @$item["id"]) }}"
                        >
                    </td>
                    <td class="product-subtotal">
                        <span class="amount">{{ number_format(@$totalPrice) }}</span>
                        <span>VND</span>
                    </td>
                    <td class="plantmore-product-remove">
                        <a class="delete-cart" href="" data-id="{{ @$item['id'] }}">
                            <i class="fa fa-times"></i>
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div class="row">
        <div class="col-md-8">
            <div class="coupon-all">
                <div class="coupon2">
                    {{-- <a href="#" class="update-btn">Cập nhật giỏ hàng</a> --}}
                    <a href="{{ route("shop.index") }}" class=" continue-btn">Tiếp tục mua hàng</a>
                </div>

            </div>
        </div>
        <div class="col-md-4 ml-auto">
            <div class="cart-page-total">
                <h2>Đơn hàng</h2>

                <ul>
                    <li>Giảm giá <span>@if(isset($coupon)) - {{ $coupon -> percentage }} VND @else - 0 VND @endif</span></li>
                    <li class="d-flex justify-content-between">
                        <span>Tạm tính</span>
                        <div>
                            <span class="ml-1">VND</span>
                            <span id="total-price-cart">
                                {{ number_format(@$cartTotal - @$coupon -> percentage) }}
                            </span>
                        </div>
                    </li>
                </ul>

                <a class="proceed-checkout-btn">Thanh toán</a>
            </div>
        </div>
    </div>
    @else
        <div class="col-lg-12 d-flex justify-content-center">
            <span class="cart-notification">Giỏ hàng trống</span>
        </div>
    @endif
</form>

<style>
    .update-btn{
        margin-right: 10px;
        padding: 9px 15px;
        background: #000000;
        color: #fff;
    }

    .update-btn:hover{
        background: #c89979 !important;
        color: #fff !important;
    }
</style>
