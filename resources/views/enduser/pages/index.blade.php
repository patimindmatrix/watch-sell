@extends("enduser.layout")
@section("head_meta")
    @include("enduser.meta", [
    "title" => "Trang chủ",
    "url" => Request::url(),
    ])
@stop
@section("front_content")
    <div class="front-content">
        <!-- Home SlideBar -->
        <div class="hero-slider hero-slider-one">
            @foreach($slidebars as $key => $slidebar)
                <div class="single-slide" style="background-image: url({{ \App\Helper\Functions::getImage('banner', $slidebar -> picture) }})">
                    <div class="hero-content-one container">
                        <div class="row">
                            <div class="col-lg-12 col-md-12">
                                <div class="slider-content-text text-left">
                                    <h5>{{ $slidebar -> sale }}</h5>
                                    <h1>{{ $slidebar -> name }}</h1>
                                    <p> {{ $slidebar -> description }} </p>
                                    <p>Giảm lên đến <strong>{{ number_format($slidebar -> price_base) }} VND</strong></p>
                                    <div class="slide-btn-group">
                                        <a href="{{ route("shop.index") }}" class="btn btn-bordered btn-style-1">Mua hàng ngay</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <!-- Home SlideBar Section End -->

        <!-- Banner Area Start -->
        <div class="banner-area section-pt">
            <div class="container">
                <div class="row">
                    @foreach($banner_below_slidebar as $banner)
                        <div class="col-lg-6 col-md-6">
                            <div class="single-banner mb-30">
                                <a href="{{ route("shop.showProductByBrand", ["slug" => @$banner->slug]) }}">
                                    <img
                                        style="border-radius: 5px;"
                                        src="{{ \App\Helper\Functions::getImage("banner", @$banner -> picture) }}" alt="">
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <!-- Banner Area End -->

        <!-- Sản phẩm bán chạy -->
        <div class="product-area section-pb section-pt-30">
            <div class="container">

                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-title">
                            <h4>Sản phẩm bán chạy</h4>
                        </div>
                    </div>
                </div>

                <div class="row product-active-lg-4">
                    @foreach($best_seller as $product)
                        <div class="col-lg-12">
                            <!-- single-product-area start -->
                            <div class="single-product-area mt-30">
                                <div class="product-thumb">
                                    <a class="product-wrapper" href="{{ route("shop.productDetail", ['slug' => $product -> slug]) }}">
                                        <img class="primary-image" src="{{ \App\Helper\Functions::getImage("product", $product -> picture) }}" alt="">
                                    </a>
                                    @include("enduser.components.actions", ["id_cart" => $product -> id, "amount" => $product->amount])
                                </div>
                                <div class="product-caption">
                                    <h4 class="product-name"><a href="{{ route("shop.productDetail", ['slug' => $product -> slug]) }}">{{ $product -> name }}</a></h4>
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
        <!-- Product Area End -->

        <!-- Banner Area Start -->
        <div class="banner-area">
            <div class="container">
                <div class="row">
                    @foreach($banners as $item)
                        <div class="col-lg-6 col-md-6">
                            <div class="single-banner mb-30">
                                <a href="{{ route("shop.showProductByBrand", ["slug" => $item->slug]) }}">
                                    <img
                                        style="border-radius: 5px;"
                                        src="{{ \App\Helper\Functions::getImage("banner", $item -> picture) }}" alt="">
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <!-- Banner Area End -->

        <!-- Sản phẩm mới -->
        <div class="product-area section-pb section-pt-30">
            <div class="container">

                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-title">
                            <h4>Sản phẩm sale</h4>
                        </div>
                    </div>
                </div>

                <div class="row product-active-lg-4">
                    @foreach($product_sale as $product)
                        <div class="col-lg-12">
                            <!-- single-product-area start -->
                            <div class="single-product-area mt-30">
                                <div class="product-thumb">
                                    <a class="product-wrapper" href="{{ route("shop.productDetail", ['slug' => $product -> slug]) }}">
                                        <img class="primary-image" src="{{ \App\Helper\Functions::getImage("product", $product -> picture) }}" alt="">
                                    </a>
                                    @include("enduser.components.actions", ["id_cart" => $product -> id, "amount" => $product->amount])
                                </div>
                                <div class="product-caption">
                                    <h4 class="product-name"><a href="">{{ $product -> name }}</a></h4>
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
        <!-- Product Area End -->

        <!-- our-brand-area start -->
        <div class="our-brand-area section-pb">
            <div class="container">
                @include("enduser.components.partner", ["partners" => $partners])
            </div>
        </div>
        <!-- our-brand-area end -->

        <!-- letast blog area Start -->
        <div class="letast-blog-area section-pb">
            <div class="container">
                <div class="row">
                @foreach($blogs as $blog)
                    <div class="col-lg-4">
                        <div class="singel-latest-blog">
                            <div class="aritcles-content">
                                <div class="author-name">
                                    Đăng bởi: <a href="#"> {{ @$blog -> author }}</a> - {{ date_format(@$blog-> updated_at, "d/m/Y H:i:s") }}
                                </div>
                                <h4>
                                    <a href="{{ route("blog.blogDetail", ["slug" => @$blog -> slug]) }}" class="articles-name">
                                        {{ @$blog -> name }}
                                    </a>
                                </h4>
                            </div>
                            <div class="articles-image">
                                <a href="{{ route("blog.blogDetail", ["slug" => @$blog -> slug]) }}">
                                    <img src="{{ \App\Helper\Functions::getImage("blog", @$blog -> picture, "thumbnail") }}" alt="">
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
                </div>
            </div>
        </div>
        <!-- letast blog area End -->

    </div>
@stop

