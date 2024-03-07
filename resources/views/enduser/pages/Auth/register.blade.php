@extends("enduser.layout")
@section("head_meta")
    @include("enduser.meta", [
    "title" => "Đăng ký",
    "url" => Request::url(),
    ])
@stop
@section("front_content")
    <!-- breadcrumb-area start -->
    <div class="breadcrumb-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    @include("enduser.components.breadcrumb", ["currentPage" => "Đăng ký"])
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb-area end -->

    <!-- main-content-wrap start -->
    <div class="main-content-wrap section-ptb lagin-and-register-page">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 col-md-12 ml-auto mr-auto">
                    <div class="login-register-wrapper">
                        <!-- login-register-tab-list start -->
                        <div class="login-register-tab-list nav">
                            <a href="{{ route("auth.login") }}">
                                <h4> đăng nhập </h4>
                            </a>
                            <a class="active" href="{{ route("auth.register") }}">
                                <h4> đăng ký </h4>
                            </a>
                        </div>
                        <!-- login-register-tab-list end -->
                        <div class="tab-content">
                            <div class="tab-pane active">
                                <div class="login-form-container">
                                    <div class="login-register-form">
                                        <form action="{{ route("auth.checkRegister") }}" method="post">
                                            @csrf
                                            @include("admin.template.error")
                                            <div class="login-input-box">
                                                <input type="text" name="user_name" placeholder="Tên tài khoản...">
                                                <input name="email" placeholder="Email..." type="email">
                                                <input type="password" name="password" placeholder="Mật khẩu...">
                                                <input type="password" name="password_confirmation" placeholder="Nhập lại mật khẩu...">
                                                <input type="text" name="phone" placeholder="Số điện thoại...">
                                            </div>
                                            <div class="button-box">
                                                <button class="register-btn btn" type="submit">
                                                    <span>Đăng ký</span>
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- main-content-wrap end -->
@stop
