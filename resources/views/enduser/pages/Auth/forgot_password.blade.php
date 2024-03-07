@php
    //dd(Request::url());
@endphp

@extends("enduser.layout")
@section("head_meta")
    @include("enduser.meta", [
    "title" => "Lấy lại mật khẩu",
    "url" => Request::url(),
    ])
@stop
@section("front_content")
    <!-- breadcrumb-area start -->
    <div class="breadcrumb-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    @include("enduser.components.breadcrumb", ["currentPage" => "Lấy lại mật khẩu"])
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb-area end -->

    <!-- main-content-wrap start -->
    <div class="main-content-wrap section-ptb lagin-and-register-page">
        <div class="container">
            <div class="row">
                <div class="col-lg-9 col-md-12 ml-auto mr-auto">
                    <div class="login-register-wrapper">
                        <!-- login-register-tab-list start -->
                        <div class="login-register-tab-list nav">
                            <a class="active" href="{{ route("auth.viewForgotPassword") }}">
                                <h4> quên mật khẩu </h4>
                            </a>
                        </div>
                        <!-- login-register-tab-list end -->
                        <div class="tab-content">
                            <div class="tab-pane active">
                                <div class="login-form-container" style="padding: 30px">
                                    <div class="login-register-form">
                                        @include("admin.template.notify")
                                        <form id="form_resetPassword" data-url="{{ route("sendEmail.mailToRetrievePassword") }}">
                                            @csrf
                                            <div class="login-input-box d-flex">
                                                <input style="width: 78% !important;" type="text" name="email" class="mb-0" placeholder="Nhập địa chỉ email để lấy lại mật khẩu...">
                                                <button class="login-btn btn mt-0 ml-3 h-50" type="submit"><span>xác nhận</span></button>
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
