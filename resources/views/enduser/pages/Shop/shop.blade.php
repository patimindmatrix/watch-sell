@extends("enduser.layout")
@section("head_meta")
    @include("enduser.meta", [
    "title" => "Cửa hàng",
    "url" => Request::url(),
    ])
@stop
@section("front_content")
    <!-- breadcrumb-area start -->
    <div class="breadcrumb-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <!-- breadcrumb-list start -->
                    @include("enduser.components.breadcrumb", ['currentPage' => 'Shop'])
                    <!-- breadcrumb-list end -->
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb-area end -->


    <!-- main-content-wrap start -->
    <div class="main-content-wrap shop-page section-ptb">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 order-lg-1 order-2">
                    <!-- shop-sidebar-wrap start -->
                    <div class="shop-sidebar-wrap">
                        <div class="shop-box-area">
                            @include("enduser.components.sidebar_categories" , ["categories" => $categories])
                            @include("enduser.components.sidebar_filter_price",["route" => Request::url()])
                            <!-- shop-sidebar start -->
                            @include("enduser.components.sidebar_tags")
                            <!-- shop-sidebar end -->

                        </div>
                    </div>
                    <!-- shop-sidebar-wrap end -->
                </div>
                <div class="col-lg-9 order-lg-2 order-1">

                    <!-- shop-product-wrapper start -->
                    <div class="shop-product-wrapper">
                        <div class="row align-itmes-center">
                            <div class="col">
                                <!-- shop-top-bar start -->
                                <div class="shop-top-bar">
                                   @include("enduser.components.sort")
                                </div>
                                <!-- shop-top-bar end -->
                            </div>
                        </div>

                        <!-- shop-products-wrap start -->
                        <div class="shop-products-wrap">
                            <div class="tab-content">
                                <div class="tab-pane active" id="grid">
                                    <div class="shop-product-wrap">
                                        <div class="row">
                                            @if(count($products) > 0)
                                            @foreach($products as $product)
                                                <div class="col-lg-4 col-md-6">
                                                <!-- single-product-area start -->
                                                <div class="single-product-area mt-30">
                                                    <div class="product-thumb">
                                                        <a class="product-wrapper" href="{{ route("shop.productDetail", ['slug' => $product -> slug]) }}">
                                                            <img class="primary-image" src="{{ \App\Helper\Functions::getImage("product", $product->picture) }}" alt="">
                                                        </a>
                                                        @switch($product -> type)
                                                            @case("mới")
                                                                <div class="label-product label-new">{{ $product->type }}</div>
                                                            @break
                                                            @case("giảm giá")
                                                                <div class="label-product bg-warning">{{ $product->type }}</div>
                                                            @break
                                                        @endswitch
                                                        @if($product->amount === 0)
                                                            <div class="label-product bg-danger">Hết hàng</div>
                                                        @endif
                                                        @include("enduser.components.actions", ["id_cart" => $product -> id, "amount" => $product->amount])
                                                    </div>
                                                    <div class="product-caption">
                                                        <h4 class="product-name"><a href="#">{{ $product -> name }}</a></h4>
                                                        <div class="price-box">
                                                            @if($product -> price_final == $product -> price_base)
                                                                <span class="new-price">{{ number_format($product -> price_final) }} VND</span>
                                                            @else
                                                                <span class="new-price">{{ number_format($product -> price_final) }} VND</span>
                                                                <span class="old-price">{{ number_format($product -> price_base) }} VND</span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- single-product-area end -->
                                            </div>
                                            @endforeach
                                            @else
                                                <span style="font-size: 24px;text-transform: uppercase;color: #333333;font-weight: 500;text-align: center;width: 100%;">Không có sản phẩm nào</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- shop-products-wrap end -->

                        <!-- paginatoin-area start -->
                        @include("enduser.components.pagination", ["pagination" => $products])
                        <!-- paginatoin-area end -->
                    </div>
                    <!-- shop-product-wrapper end -->
                </div>
            </div>
        </div>
    </div>
    <!-- main-content-wrap end -->
@stop
