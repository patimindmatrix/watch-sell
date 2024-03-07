@php
    //dd(Request::url());
@endphp

@extends("enduser.layout")
@section("head_meta")
    @include("enduser.meta", [
    "title" => "Đăng nhập",
    "url" => Request::url(),
    ])
@stop
@section("front_content")
    <!-- breadcrumb-area start -->
    <div class="breadcrumb-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                   @include("enduser.components.breadcrumb", ["currentPage" => "Đăng nhập"])
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
                            <a class="active" href="{{ route("auth.login") }}">
                                <h4> đăng nhập </h4>
                            </a>
                            <a href="{{ route("auth.register") }}">
                                <h4> đăng ký </h4>
                            </a>
                        </div>
                        <!-- login-register-tab-list end -->
                        <div class="tab-content">
                            <div class="tab-pane active">
                                <div class="login-form-container">
                                    <div class="login-register-form">
                                        @include("admin.template.notify")
                                        <form action="{{ route("auth.checkLogin") }}" method="post">
                                            @csrf
                                            <div class="login-input-box">
                                                <input type="text" name="email" placeholder="Email">
                                                <input type="password" name="password" placeholder="Password">
                                            </div>
                                            <div class="button-box">
                                                <div class="login-toggle-btn pure-checkbox">
                                                    <input class="checkbox" type="checkbox" name="remember_me" id="remember_me">
                                                    <label for="remember_me" style="cursor: pointer">Remember me</label>
                                                    <a href="{{ route("auth.viewForgotPassword") }}">Quên mật khẩu ?</a>
                                                </div>
                                                <div class="button-box">
                                                    <button class="login-btn btn" type="submit"><span>Đăng nhập</span></button>
                                                </div>
                                            </div>
                                            <p class="text-center font-weight-bold">Hoặc đăng nhập với</p>
                                            <ul class="social-icons d-flex justify-content-center">
                                                @foreach(['facebook', 'google'] as $provider)
                                                    <li>
                                                        <a href="{{ route("auth.socialLogin", ['provider' => $provider]) }}" class="{{$provider}} social-icon" title="{{ ucfirst($provider) }}" style="height: 70px; width: 70px;">
                                                            <i class="fab fa-{{$provider}}" style="line-height: 70px; font-size: 35px"></i>
                                                        </a>
                                                    </li>
                                                @endforeach
                                            </ul>
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
