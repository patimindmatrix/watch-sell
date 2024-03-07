@extends("enduser.layout")
@section("head_meta")
    @include("enduser.meta", [
    "title" => @$single_product -> name,
    "url" => Request::url(),
    ])
@stop
@section("front_content")
    <!-- breadcrumb-area start -->
    <div class="breadcrumb-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                   @include("enduser.components.breadcrumb", ['currentPage' => 'Chi tiết sản phẩm'])
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb-area end -->

    <!-- main-content-wrap start -->
    <div class="main-content-wrap shop-page section-ptb">
        <div class="container">
            <div class="row  product-details-inner">
                <div class="col-lg-5 col-md-6">
                    <!-- Product Details Left -->
                    <div class="product-large-slider">
                        @php
                            $gallery = json_decode($single_product -> gallery, true);
                        @endphp
                        <div class="pro-large-img img-zoom">
                            <img src="{{ \App\Helper\Functions::getImage("product",@$single_product -> picture) }}" alt="product-details" />
                            <a href="{{ \App\Helper\Functions::getImage("product",@$single_product -> picture) }}" data-fancybox="images"><i class="fa fa-search"></i></a>
                        </div>

                    </div>
{{--                    <div class="product-nav">--}}
{{--                        @foreach($gallery as $item)--}}
{{--                            <div class="pro-nav-thumb">--}}
{{--                                <img src="{{ \App\Helper\Functions::getImage("product", $item) }}" alt="product-details" />--}}
{{--                            </div>--}}
{{--                        @endforeach--}}
{{--                    </div>--}}
                    <!--// Product Details Left -->
                </div>

                <div class="col-lg-7 col-md-6">
                    <div class="product-details-view-content">
                        <div class="product-info">
                            <h3>{{ @$single_product -> name }}</h3>
                            <div class="product-rating d-flex rating-info">
                                @php
                                    //Lấy avg rating
                                    $avg_rating = $reviews -> avg('rating');
                                @endphp
                                <ul class="product-rating d-flex mb-10">
                                    @for($i = 1; $i <= 5; ++$i)
                                        <li class="star-rating @if($i <= @$avg_rating)selected @endif"><i class='fa fa-star fa-fw'></i></li>
                                    @endfor
                                </ul>
                                @if(count(@$reviews) > 0)
                                    <p>( Có <span class="count">{{ count(@$reviews) }}</span> đánh giá )</p>
                                @else
                                    <p>( <span class="count">0</span> đánh giá )</p>
                                @endif
                            </div>
                            <div class="price-box">
                                @if(@$single_product -> price_final == @$single_product -> price_base)
                                    <span class="new-price">{{ number_format(@$single_product -> price_final) }} VND</span>
                                @else
                                    <span class="new-price">{{ number_format(@$single_product -> price_final) }} VND</span>
                                    <span class="old-price">{{ number_format(@$single_product -> price_base) }} VND</span>
                                @endif
                            </div>

                            <div class="single-add-to-cart">
                                <form action="" class="cart-quantity d-flex" method="GET"
                                      data-url="{{ route("cart.addCartForDetailProduct", ["id" => @$single_product -> id]) }}"
                                >
                                    <div class="quantity">
                                        <div class="cart-plus-minus">
                                            <input
                                                type="text" min="0" maxlength="3"
                                                class="input-text quantity input-quantity"
                                                name="quantity" value="0"
                                                data-check-cart="true"
                                                data-url="{{ route('cart.checkProductQuantity', $single_product->id) }}"
                                            >
                                        </div>
                                    </div>
                                    @if(@$single_product->amount > 0)
                                        <button class="add-to-cart" type="submit">Thêm giỏ hàng</button>
                                    @else
                                        <button style="cursor: auto; background: #ccc; border: 1px solid #ccc;color: white; padding: 5px 10px" disabled>Thêm giỏ hàng</button>
                                    @endif
                                </form>
                            </div>
                            <ul class="single-add-actions">
                                <li class="add-to-wishlist">
                                    <a data-url="{{ route("wishList.addWishList", ["id" => @$single_product -> id]) }}" class="wishlist-btn ">
                                        <i class="icon-heart"></i> Thêm vào danh sách yêu thích
                                    </a>
                                </li>
                            </ul>
                            <ul class="stock-cont">
                                <li class="product-sku">Số lượng: <span>{{ @$single_product -> amount }}</span></li>
                                <li class="product-stock-status">Danh mục:
                                    <a href="{{ route("shop.showProductByCategory",["slug" => @$single_product -> categories -> slug]) }}">
                                        {{ @$single_product -> categories -> name }}
                                    </a>
                                </li>
                                @php
                                    $tags = $single_product -> tags() -> pluck('name') -> toArray();
                                @endphp
                                <li class="product-stock-status">Nhãn:
                                    @foreach($tags as $tag)
                                         <a href="#">{{ $tag }},</a>
                                    @endforeach
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="product-description-area section-pt">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="product-details-tab">
                            <ul role="tablist" class="nav">
                                <li class="active" role="presentation">
                                    <a data-toggle="tab" role="tab" href="#info" class="active">Thông tin sản phẩm</a>
                                </li>
                                <li role="presentation">
                                    <a data-toggle="tab" role="tab" href="#reviews">Reviews ({{ count(@$reviews) }})</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="product_details_tab_content tab-content">
                            <!-- Start Single Content -->
                            <div class="product_tab_content tab-pane active" id="info" role="tabpanel">
                                <div class="product_description_wrap  mt-30">
                                    <div class="product_desc mb-30">
                                        {!! @$single_product -> information !!}
                                    </div>
                                </div>
                            </div>
                            <!-- End Single Content -->
                            <!-- Start Single Content -->
                            <div class="product_tab_content tab-pane" id="reviews" role="tabpanel">
                                <div class="review_address_inner mt-30">
                                    @include("enduser.components.review_product", ["reviews" => @$reviews])
                                </div>
                                <!-- Start RAting Area -->
                                @if(\Illuminate\Support\Facades\Auth::check())
                                    <div class="rating_wrap mt-50">
                                        <h6 class="rating-title-2">Đánh giá của bạn</h6>
                                        <div class="rating_list">
                                            <div class="review_info mb-10 rating-stars">
                                                <ul class="product-rating d-flex mb-10" id="stars">
                                                    <li class="star" data-count="1"><i class='fa fa-star fa-fw'></i></li>
                                                    <li class="star" data-count="2"><i class='fa fa-star fa-fw'></i></li>
                                                    <li class="star" data-count="3"><i class='fa fa-star fa-fw'></i></li>
                                                    <li class="star" data-count="4"><i class='fa fa-star fa-fw'></i></li>
                                                    <li class="star" data-count="5"><i class='fa fa-star fa-fw'></i></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End RAting Area -->

                                    <div class="comments-area comments-reply-area">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <form action="{{ route("review.storeReview", ["id" => $single_product -> id]) }}" method="POST" class="comment-form-area">
                                                    @csrf
                                                    <input type="hidden" value="" name="rating" class="rating-input">
                                                    <div class="comment-form-comment mt-15">
                                                        <label>Nội dung review</label>
                                                        <textarea class="comment-notes" required="required" name="review"></textarea>
                                                    </div>
                                                    <div class="comment-form-submit mt-15">
                                                        <input type="submit" value="Gửi" class="comment-submit">
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <a href="{{ route("auth.login") }}" class="login-to-comment mt-5">
                                        <div class="comment-wrapper">
                                            <i class="far fa-comment mr-1"></i>
                                            <p>Đăng nhập để review sản phẩm</p>
                                        </div>
                                    </a>
                                @endif
                            </div>
                            <!-- End Single Content -->
                        </div>
                    </div>
                </div>
            </div>

            <div class="related-product-area section-pt">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-title">
                            <h3> Sản phẩm cùng thương hiệu </h3>
                        </div>
                    </div>
                </div>
                <div class="row product-active-lg-4">
                    @foreach($related_products as $item)
                        <div class="col-lg-12">
                            <!-- single-product-area start -->
                            <div class="single-product-area mt-30">
                                <div class="product-thumb">
                                    <a href="{{ route("shop.productDetail", ["slug" => @$item -> slug]) }}" class="d-flex justify-content-center">
                                        <img class="primary-image" src="{{ \App\Helper\Functions::getImage("product", @$item -> picture) }}" alt="">
                                    </a>
                                    @switch($item -> type)
                                        @case("mới")
                                        <div class="label-product label-new">{{ $item->type }}</div>
                                        @break
                                        @case("giảm giá")
                                        <div class="label-product label-sale">{{ $item->type }}</div>
                                        @break
                                    @endswitch
                                    @if($item->amount === 0)
                                        <div class="label-product bg-danger">Hết hàng</div>
                                    @endif
                                    @include("enduser.components.actions", ["id_cart" => @$item->id, "amount" => @$item->amount])
                                </div>
                                <div class="product-caption">
                                    <h4 class="product-name"><a href="product-details.html">{{ @$item -> name }}</a></h4>
                                    <div class="price-box">
                                        @if(@$item -> price_final == @$item -> price_base)
                                            <span class="new-price">{{ number_format(@$item -> price_final) }} VND</span>
                                        @else
                                            <span class="new-price">{{ number_format(@$item -> price_final) }} VND</span>
                                            <span class="old-price">{{ number_format(@$item -> price_base) }} VND</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <!-- single-product-area end -->
                        </div>
                    @endforeach
                </div>
            </div>

        </div>
    </div>
    <!-- main-content-wrap end -->
@stop
