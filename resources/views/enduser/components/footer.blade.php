@php
    $footer1 = \App\Widget::where('location','footer 1')->first();
    $footer2 = \App\Widget::where('location','footer 2')->first();
    $footer3 = \App\Widget::where('location','footer 3')->first();
    $contact = \App\Setting::where('status','active')->get();
@endphp

<footer>
    <div class="footer-top pb-3">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="widget-footer mt-40">
                        <h6 class="title-widget">{{ $footer1 -> name }}</h6>
                        <div class="footer-addres">
                            <div class="widget-content mb--20">
                                {!! $footer1 -> content !!}
                            </div>
                        </div>
                        <ul class="social-icons">
                            @foreach($contact as $social)
                                <li>
                                    <a class="{{ @$social->name }} social-icon" href="{{ @$social->link }}" title="{{ @$social->name }}" target="_blank">
                                        {!! @$social -> icon !!}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                <div class="col-lg-2 col-md-6 col-sm-6">
                    <div class="widget-footer mt-40">
                        <h6 class="title-widget">{{ $footer2 -> name }}</h6>
                        <div class="widget-content mb--20">
                            {!! $footer2 -> content !!}
                        </div>
                    </div>
                </div>

                <div class="col-lg-2 col-md-6 col-sm-6">
                    <div class="widget-footer mt-40">
                        <h6 class="title-widget">{{ $footer3 -> name }}</h6>
                        <div class="widget-content mb--20">
                            {!! $footer3 -> content !!}
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="widget-footer mt-40">
                        <h6 class="title-widget">Tải App</h6>
                        <ul class="footer-list">
                            <li><img src="{{ asset("picture/img-googleplay.jpg") }}" alt=""></li>
                            <li><img src="{{ asset("picture/img-appstore.jpg") }}" alt=""></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="footer-bottom" style="padding: 15px 0 !important;">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-6">
                    <div class="copy-left-text">
                        <p>Copyright &copy; <a href="#">Ruiz</a> 2019. All Right Reserved.</p>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="copy-right-image">
                        <img src="{{ asset("picture/img-payment.png") }}" alt="">

                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

