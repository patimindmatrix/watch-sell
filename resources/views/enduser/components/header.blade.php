@php
    use Harimayco\Menu\Facades\Menu;
    use Harimayco\Menu\Models\MenuItems;
    $menus = MenuItems::all();
@endphp

<header class="header">

    <!-- haeader Mid Start -->
    <div class="haeader-mid-area bg-gren border-bm-1 d-none d-lg-block ">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-3 col-md-4 col-5">
                    <div class="logo-area">
                        <a href="{{ route("page.index") }}">
                            <img src="{{ asset("picture/logo.png") }}" alt=""></a>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="search-box-wrapper">
                        <div class="search-box-inner-wrap">
                            <form class="search-box-inner" method="GET" action="{{ route("shop.searchBrand") }}">
                                <div class="search-field-wrap">
                                    <input type="text" class="search-field search-brand" placeholder="Tìm kiếm thương hiệu..." name="keyword">

                                    <div class="search-btn">
                                        <button class="btn-confirm"><i class="icon-magnifier"></i></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3">
                    <div class="right-blok-box text-white d-flex">

                        <div class="user-wrap">
                            <a href="{{ route("wishList.showWishList") }}">
                                <span class="cart-total" id="count-wishlist">@if(!empty($wishlist)){{ count($wishlist) }} @else 0 @endif</span>
                                <i class="icon-heart"></i>
                            </a>
                        </div>

                        <div class="shopping-cart-wrap">
                            <a href="#">
                                <i class="icon-basket-loaded"></i>
                                <span class="cart-total">@if(!empty($carts)){{ count(@$carts) }} @else 0 @endif</span>
                            </a>
                            <ul class="mini-cart" style="width: 350px;">
                                @if(!empty($carts))
                                    @foreach($carts as $item)
                                        @php
                                            $totalPrice = @$totalPrice + $item['subtotal'];
                                        @endphp
                                        <li class="cart-item">
                                            <div class="cart-image d-flex justify-content-center">
                                                <a href="{{ route("shop.productDetail", ["slug" => @$item['slug']]) }}">
                                                    <img width="50" alt="{{ $item['name'] }}" src="{{ \App\Helper\Functions::getImage("product", $item['picture'], "standard") }}">
                                                </a>
                                            </div>
                                            <div class="cart-title">
                                                <a href="{{ route("shop.productDetail", ["slug" => @$item['slug']]) }}">
                                                    <h4>{{ $item['name'] }}</h4>
                                                </a>
                                                <div class="quanti-price-wrap">
                                                    <span class="quantity">{{ $item['quantity'] }} ×</span>
                                                    <div class="price-box"><span class="new-price">{{ number_format($item['subtotal']) }} VND</span></div>
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach
                                    <li class="subtotal-box">
                                        <div class="subtotal-title">
                                            <h3>Tổng tiền :</h3>
                                            <span>{{number_format(@$totalPrice)}} VND</span>
                                        </div>
                                    </li>
                                    <li class="mini-cart-btns">
                                        <div class="cart-btns">
                                            <a href="{{ route("cart.showCart") }}">Giỏ hàng</a>
                                            <a href="{{ route("checkout.checkLoginToCheckOut") }}">Thanh toán</a>
                                        </div>
                                    </li>
                                @else
                                    <li class="cart-item p-0 justify-content-center">
                                        <span class="text-dark"> Giỏ hàng trống !!</span>
                                    </li>
                                @endif
                            </ul>
                        </div>

                        <div class="user-home ml-2">
                            @php
                                if(\Illuminate\Support\Facades\Auth::check()){
                                    $route = route("user_profile.showAccountDetail");
                                }
                                else{
                                    $route = route("auth.login");
                                }
                            @endphp
                            <a href="{{@$route}}">
                                <i class="icon-user"></i>
                            </a>
                        </div>

                        @if(\Illuminate\Support\Facades\Auth::check())
                            <div class="user-logout ml-2">
                                <a href="{{ route("auth.logout") }}">
                                    <i class="icon-logout"></i>
                                </a>
                            </div>
                        @endif
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- haeader Mid End -->

    <!-- haeader bottom Start -->
    <div class="haeader-bottom-area bg-gren header-sticky">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12 d-none d-lg-block">
                    <div class="main-menu-area white_text">
                        <!--  Start Mainmenu Nav-->
                        <nav class="main-navigation text-center">
                            <ul>
                                @foreach($menus as $menu)
                                    @if($menu -> parent != 0)
                                        <li class="active"><a href="index.html">Home <i class="fa fa-angle-down"></i></a>
                                            <ul class="sub-menu">
                                                <li><a href="index.html">Home Page 1</a></li>
                                                <li><a href="https://demo.hasthemes.com/ruiz-preview/ruiz/index-2.html">Home Page 2</a></li>
                                            </ul>
                                        </li>
                                    @else
                                        <li><a href="{{ $menu -> link }}"> {{ $menu -> label }}</a></li>
                                    @endif
                                @endforeach
                            </ul>
                        </nav>

                    </div>
                </div>

                <div class="col-5 col-md-6 d-block d-lg-none">
                    <div class="logo"><a href="index.html"><img src="https://demo.hasthemes.com/ruiz-preview/ruiz/assets/images/logo/logo.png" alt=""></a></div>
                </div>


                <div class="col-lg-3 col-md-6 col-7 d-block d-lg-none">
                    <div class="right-blok-box text-white d-flex">

                        <div class="user-wrap">
                            <a href="https://demo.hasthemes.com/ruiz-preview/ruiz/wishlist.html">
                                <span class="cart-total">2</span>
                                <i class="icon-heart"></i>
                            </a>
                        </div>

                        <div class="shopping-cart-wrap">
                            <a href="#">
                                <i class="icon-basket-loaded"></i>
                                <span class="cart-total">3</span>
                            </a>
                            <ul class="mini-cart">
                                <li class="cart-item">
                                    <div class="cart-image">
                                        <a href="https://demo.hasthemes.com/ruiz-preview/ruiz/product-details.html"><img alt="" src="https://demo.hasthemes.com/ruiz-preview/ruiz/assets/images/product/product-02.png"></a>
                                    </div>
                                    <div class="cart-title">
                                        <a href="https://demo.hasthemes.com/ruiz-preview/ruiz/product-details.html">
                                            <h4>Product Name 01</h4>
                                        </a>
                                        <div class="quanti-price-wrap">
                                            <span class="quantity">1 ×</span>
                                            <div class="price-box"><span class="new-price">$130.00</span></div>
                                        </div>
                                        <a class="remove_from_cart" href="#"><i class="fa fa-times"></i></a>
                                    </div>
                                </li>
                                <li class="cart-item">
                                    <div class="cart-image">
                                        <a href="https://demo.hasthemes.com/ruiz-preview/ruiz/product-details.html"><img alt="" src="https://demo.hasthemes.com/ruiz-preview/ruiz/assets/images/product/product-03.png"></a>
                                    </div>
                                    <div class="cart-title">
                                        <a href="https://demo.hasthemes.com/ruiz-preview/ruiz/product-details.html">
                                            <h4>Product Name 03</h4>
                                        </a>
                                        <div class="quanti-price-wrap">
                                            <span class="quantity">1 ×</span>
                                            <div class="price-box"><span class="new-price">$130.00</span></div>
                                        </div>
                                        <a class="remove_from_cart" href="#"><i class="icon-trash icons"></i></a>
                                    </div>
                                </li>
                                <li class="subtotal-box">
                                    <div class="subtotal-title">
                                        <h3>Sub-Total :</h3><span>$ 260.99</span>
                                    </div>
                                </li>
                                <li class="mini-cart-btns">
                                    <div class="cart-btns">
                                        <a href="https://demo.hasthemes.com/ruiz-preview/ruiz/cart.html">View cart</a>
                                        <a href="https://demo.hasthemes.com/ruiz-preview/ruiz/checkout.html">Checkout</a>
                                    </div>
                                </li>
                            </ul>
                        </div>

                        <div class="mobile-menu-btn d-block d-lg-none">
                            <div class="off-canvas-btn">
                                <a href="#"><img src="https://demo.hasthemes.com/ruiz-preview/ruiz/assets/images/icon/bg-menu.png" alt=""></a>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- haeader bottom End -->

    <!-- off-canvas menu start -->
    <aside class="off-canvas-wrapper">
        <div class="off-canvas-overlay"></div>
        <div class="off-canvas-inner-content">
            <div class="btn-close-off-canvas">
                <i class="fa fa-times"></i>
            </div>

            <div class="off-canvas-inner">

                <div class="search-box-offcanvas">
                    <form>
                        <input type="text" placeholder="Search product...">
                        <button class="search-btn"><i class="icon-magnifier"></i></button>
                    </form>
                </div>

                <!-- mobile menu start -->
                <div class="mobile-navigation">

                    <!-- mobile menu navigation start -->
                    <nav>
                        <ul class="mobile-menu">
                            @foreach($menus as $menu)
                                @if($menu -> parent != 0)
                                    <li class="active"><a href="index.html">Home <i class="fa fa-angle-down"></i></a>
                                        <ul class="sub-menu">
                                            <li><a href="index.html">Home Page 1</a></li>
                                            <li><a href="https://demo.hasthemes.com/ruiz-preview/ruiz/index-2.html">Home Page 2</a></li>
                                        </ul>
                                    </li>
                                @else
                                    <li><a href="{{ $menu -> link }}"> {{ $menu -> label }}</a></li>
                                @endif
                            @endforeach
                        </ul>
                    </nav>
                    <!-- mobile menu navigation end -->
                </div>
                <!-- mobile menu end -->


                <div class="header-top-settings offcanvas-curreny-lang-support">
                    <h5>My Account</h5>
                    <ul class="nav align-items-center">
                        <li class="language">English <i class="fa fa-angle-down"></i>
                            <ul class="dropdown-list">
                                <li><a href="#">English</a></li>
                                <li><a href="#">French</a></li>
                            </ul>
                        </li>
                        <li class="curreny-wrap">Currency <i class="fa fa-angle-down"></i>
                            <ul class="dropdown-list curreny-list">
                                <li><a href="#">$ USD</a></li>
                                <li><a href="#"> € EURO</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>

                <!-- offcanvas widget area start -->
                <div class="offcanvas-widget-area">
                    <div class="top-info-wrap text-left text-black">
                        <h5>My Account</h5>
                        <ul class="offcanvas-account-container">
                            <li><a href="https://demo.hasthemes.com/ruiz-preview/ruiz/my-account.html">My account</a></li>
                            <li><a href="https://demo.hasthemes.com/ruiz-preview/ruiz/cart.html">Cart</a></li>
                            <li><a href="https://demo.hasthemes.com/ruiz-preview/ruiz/wishlist.html">Wishlist</a></li>
                            <li><a href="https://demo.hasthemes.com/ruiz-preview/ruiz/checkout.html">Checkout</a></li>
                        </ul>
                    </div>

                </div>
                <!-- offcanvas widget area end -->
            </div>
        </div>
    </aside>
    <!-- off-canvas menu end -->

</header>
