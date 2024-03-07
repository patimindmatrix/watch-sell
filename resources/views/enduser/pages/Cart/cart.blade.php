@extends("enduser.layout")
@section("head_meta")
    @include("enduser.meta", [
    "title" => "Giỏ hàng",
    "url" => Request::url(),
    ])
@stop
@section("front_content")
    <!-- breadcrumb-area start -->
    <div class="breadcrumb-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                   @include("enduser.components.breadcrumb", ["currentPage" => "Giỏ hàng"])
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb-area end -->

    <!-- main-content-wrap start -->
    <div class="main-content-wrap section-ptb cart-page">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    @include("enduser.components.carts")
                </div>
            </div>
        </div>
    </div>
    <!-- main-content-wrap end -->
@stop

<style>
    .cart-notification{
        font-size: 24px;
        font-weight: bold;
    }
</style>
