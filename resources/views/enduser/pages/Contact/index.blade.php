@extends("enduser.layout")
@section("head_meta")
    @include("enduser.meta",[
    'title' => "Liên hệ",
    'url' => Request::url()
])
@stop
@section("front_content")
    <!-- breadcrumb-area start -->
    <div class="breadcrumb-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    @include("enduser.components.breadcrumb", ["currentPage" => "Liên hệ"])
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb-area end -->

    <!-- Page Conttent -->
    <main class="page-content section-ptb">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 col-sm-12">
                    <div class="contact-form">
                        <div class="contact-form-info">
                            <div class="contact-title">
                                <h3>Để lại lời nhắn của bạn ở đây</h3>
                            </div>
                            @include("admin.template.notify")
                            <form action="{{ route("sendEmail.mailToMessageAdmin") }}" method="POST">
                                @csrf
                                <div class="contact-page-form">
                                    <div class="contact-input">
                                        <div class="contact-inner">
                                            @if($errors -> has("con_name"))
                                                <p class="error-text">{{ $errors -> first("con_name") }}</p>
                                            @endif
                                            <input name="con_name" type="text" placeholder="Họ và tên">
                                        </div>
                                        <div class="contact-inner">
                                            @if($errors -> has("con_email"))
                                                <p class="error-text">{{ $errors -> first("con_email") }}</p>
                                            @endif
                                            <input name="con_email" type="email" placeholder="Email">
                                        </div>
                                        <div class="contact-inner">
                                            @if($errors -> has("con_phone"))
                                                <p class="error-text">{{ $errors -> first("con_phone") }}</p>
                                            @endif
                                            <input name="con_phone" type="text" placeholder="Số điện thoại">
                                        </div>
                                        <div class="contact-inner contact-message">
                                            @if($errors -> has("con_message"))
                                                <p class="error-text">{{ $errors -> first("con_message") }}</p>
                                            @endif
                                            <textarea name="con_message" placeholder="Nội dung"></textarea>
                                        </div>
                                    </div>
                                    <div class="contact-submit-btn">
                                        <button class="submit-btn" type="submit">gửi email</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 col-sm-12">
                    <div class="contact-infor">
                        <div class="contact-title">
                            <h3>Liên hệ với chúng tôi</h3>
                        </div>
                        <div class="contact-dec">
                            <p> Nếu bạn có thắc mắc gì về sản phẩm hay công ty của chúng tôi, hãy điền vào form để chúng tôi giải đáp mọi vấn đề liên quan !! </p>
                        </div>
                        <div class="contact-address">
                            <ul>
                                @foreach($contacts as $contact)
                                    <li>
                                        <p><strong>{{ $contact -> name }}</strong>: {{ $contact -> content }}</p>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <!--// Page Conttent -->
@stop


