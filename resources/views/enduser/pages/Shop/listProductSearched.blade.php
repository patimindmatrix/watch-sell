@extends("enduser.layout")
@section("head_meta")
    @php
        if(count(@$products) > 0){
            $metaTitle = "Có " . count($products) . " đồng hồ liên quan tới " . $keyword ;
        }
        else{

            $metaTitle = "Không có đồng hồ liên quan tới " . $keyword ;
        }
    @endphp

    @include("enduser.meta", [
    "title" => $metaTitle,
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
                    @include("enduser.components.breadcrumb", ['currentPage' => 'Tìm kiếm sản phẩm'])
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
                    @if(count(@$products) > 0)
                        <div class="col-lg-3 order-lg-1 order-2">
                            <div class="shop-sidebar-wrap">
                                <div class="shop-box-area">
                                    @include("enduser.components.sidebar_filter_price", ["route" => Request::url() . "?keyword=" . $keyword ])
                                    @include("enduser.components.sidebar_tags")
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-9 order-lg-2 order-1">
                        <div class="shop-product-wrapper">
                            <div class="row align-itmes-center">
                                <div class="col">
                                    <h4 style="font-size: 24px; text-transform: uppercase" class="mb-3">
                                        Có {{count($products)}} sản phẩm liên quan tới "{{ $keyword }}"
                                    </h4>
                                    <form method="GET" action="">
                                        @csrf
                                        <div class="shop-top-bar">
                                            <!-- product-short start -->
                                            <div class="product-short">
                                                <p>Sort By :</p>
                                                <select class="nice-select" name="sortby" id="sortby">
                                                    <option value="{{Request::url()}}?keyword={{ $keyword }}&loc=none">- Mặc định -</option>
                                                    <option value="{{Request::url()}}?keyword={{ $keyword }}&loc=kytu-az">Tên (A - Z)</option>
                                                    <option value="{{Request::url()}}?keyword={{ $keyword }}&loc=kytu-za">Tên (Z - A)</option>
                                                    <option value="{{Request::url()}}?keyword={{ $keyword }}&loc=gia-tang-dan">Giá (Thấp > Cao)</option>
                                                    <option value="{{Request::url()}}?keyword={{ $keyword }}&loc=gia-giam-dan">Giá (Cao > Thấp)</option>
                                                </select>
                                            </div>
                                            <!-- product-short end -->
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <!-- shop-products-wrap start -->
                            <div class="shop-products-wrap">
                                <div class="tab-content">
                                    <div class="tab-pane active" id="grid">
                                        <div class="shop-product-wrap">
                                            <div class="row">
                                                @foreach($products as $product)
                                                    <div class="col-lg-4 col-md-6">
                                                        <!-- single-product-area start -->
                                                        <div class="single-product-area mt-30">
                                                            <div class="product-thumb">
                                                                <a class="product-wrapper" href="{{ route('shop.productDetail', ['slug' => $product -> slug]) }}">
                                                                    <img class="primary-image" src="{{ \App\Helper\Functions::getImage("product", $product->picture) }}" alt="">
                                                                </a>
                                                                @switch($product -> type)
                                                                    @case("mới")
                                                                    <div class="label-product label-new">{{ $product->type }}</div>
                                                                    @break
                                                                    @case("giảm giá")
                                                                    <div class="label-product label-sale">{{ $product->type }}</div>
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
                    </div>
                    @else
                        <div class="col-lg-12">
                            <h4>Không có sản phẩm được tìm thấy !</h4>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    <!-- main-content-wrap end -->
@stop
