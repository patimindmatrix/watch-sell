@extends("enduser.layout")
@section("head_meta")
    @include("enduser.meta", [
    "title" => "Thông tin cá nhân",
    "url" => Request::url(),
    ])
@stop
@section("front_content")
    @php
        @$user = \Illuminate\Support\Facades\Auth::user();
    @endphp

    <!-- breadcrumb-area start -->
    <div class="breadcrumb-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    @include("enduser.components.breadcrumb", ["currentPage" => "Trang cá nhân"])
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb-area end -->

    <div class="user-profile-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3 col-12">
                    <div class="user-sidebar-components">
                        <div class="user-avatar">
                            @if($user -> provider_id == NULL)
                                <img src="{{ \App\Helper\Functions::getImage("user", $user -> picture) }}" alt="">
                            @else
                                <img src="{{ $user -> picture }}" alt="">
                            @endif
                        </div>
                        <h4 class="user-name">{{ $user -> user_name }}</h4>
                        <div class="user-sidebar-list">
                            <a href="{{ route("user_profile.showAccountDetail") }}" class="list-item">
                                <span>Thông tin</span>
                                <i class="icon-info"></i>
                            </a>
                            <a href="{{ route("user_profile.myOrder") }}" class="list-item">
                                <span>Đơn hàng của tôi</span>
                                <i class="icon-basket-loaded"></i>
                            </a>
                            <a href="{{ route("auth.logout") }}" class="list-item">
                                <span>Đăng xuất</span>
                                <i class="icon-logout"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9 col-sm-9 col-sm-9 col-12">
                    <div class="user-layout-main">
                        @if(Request::url() == "http://localhost/ca-nhan")
                            @include("enduser.pages.Account.profile")
                        @elseif(Request::url() == "http://localhost/ca-nhan/don-hang-cua-toi")
                            @include("enduser.pages.Account.myOrder")
                        @elseif(Request::url() == "http://localhost/ca-nhan/don-hang-cua-toi/" . $order_id)
                            @include("enduser.pages.Account.orderDetails", ["id" => $order_id])
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

