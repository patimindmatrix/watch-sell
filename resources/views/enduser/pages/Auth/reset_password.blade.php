@extends("enduser.layout")
@section("front_content")
    <!-- breadcrumb-area start -->
    <div class="breadcrumb-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    @include("enduser.components.breadcrumb", ["currentPage" => "Đặt lại mật khẩu"])
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
                            <a class="active" href="{{ route("auth.viewResetPassword", ['email' => $user_email]) }}">
                                <h4> Đặt lại mật khẩu </h4>
                            </a>
                        </div>
                        <!-- login-register-tab-list end -->
                        <div class="tab-content">
                            <div class="tab-pane active">
                                <div class="login-form-container" style="padding: 30px">
                                    <div class="login-register-form" id="reset-password-wrapper">
                                        @include("admin.template.notify")
                                        <form id="form-reset-password" data-url="{{ route("auth.resetPassword", ['email' => $user_email]) }}">
                                            @csrf
                                            <div class="login-input-box" id="login-input-box">
                                                <input type="password" name="password" placeholder="Password...">
                                                <input type="password" name="password_confirmation" placeholder="Password Confirmed...">
                                                <button class="login-btn btn mt-0" type="submit" id="submit-reset-password"><span>Xác nhận</span></button>
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

<style>
    .text-error{
        color: #ff413c;
        font-size: 16px;
        font-weight: 500;
    }
</style>
