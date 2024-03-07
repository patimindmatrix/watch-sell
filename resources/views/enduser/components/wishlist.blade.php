<form action="#" class="cart-table wishlist-table" data-url="{{ route("wishList.deleteWishProduct") }}">
    @if(count($wishlist) > 0)
        <div class=" table-content table-responsive">
            <table class="table">
                <thead>
                <tr>
                    <th class="plantmore-product-thumbnail">Hình ảnh</th>
                    <th class="cart-product-name" style="width: 340px">Sản phẩm</th>
                    <th class="plantmore-product-price">Giá</th>
                    <th class="plantmore-product-add-cart">Trạng thái</th>
                    <th class="plantmore-product-remove">Xóa</th>
                </tr>
                </thead>
                <tbody>
                @foreach($wishlist as $item)
                    <tr>
                        <td class="plantmore-product-thumbnail">
                            <a href="{{ route("shop.productDetail", ["slug" => @$item['slug']]) }}">
                                <img src="{{ \App\Helper\Functions::getImage("product", @$item['picture'], "thumbnail") }}" alt="">
                            </a>
                        </td>
                        <td class="plantmore-product-name">
                            <a href="{{ route("shop.productDetail", ["slug" => @$item['slug']]) }}">{{ @$item['name'] }}</a>
                        </td>
                        <td class="plantmore-product-price"><span class="amount">{{ number_format(@$item['price']) }} VND</span></td>
                        <td class="plantmore-product-add-cart">
                            @if(@$item['amount'] > 0)
                                <a href="" class="cart-btn" data-url="{{ route("cart.addToCart", ["id" => @$item['id']]) }}">thêm giỏ hàng</a>
                            @else
                                <button class="btn btn-danger text-white" disabled>Hết hàng</button>
                            @endif
                        </td>
                        <td class="plantmore-product-remove">
                            <a href="#" class="delete-wishlist" data-id="{{ @$item['id'] }}">
                                <i class="fa fa-times"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="col-lg-12 d-flex justify-content-center">
            <span class="cart-notification font-weight-bold" style="font-size: 24px">Danh sách yêu thích trống</span>
        </div>
    @endif
</form>
