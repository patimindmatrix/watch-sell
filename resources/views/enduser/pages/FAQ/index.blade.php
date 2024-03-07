@extends("enduser.layout")
@section("head_meta")
    @include("enduser.meta",[
        'title' => 'Câu hỏi thường gặp của khách hàng',
        'url' => Request::url()
    ])
@stop
@section("front_content")
    <!-- breadcrumb-area start -->
    <div class="breadcrumb-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    @include("enduser.components.breadcrumb", ["currentPage" => "Câu hỏi thường gặp"])
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb-area end -->


    <!-- main-content-wrap start -->
    <div class="main-content-wrap section-pt">
        <div class="container">
            <div class="frequently-questions-area">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-title text-center mb-30">
                            <h2>Những câu hỏi thường gặp của khách hàng</h2>
                        </div>

                        <div class="faq-style-wrap section-pb" id="faq-five">

                            @foreach($faq as $key => $item)
                                <!-- Panel-default -->
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h5 class="panel-title">
                                                <a class="collapsed" role="button" data-toggle="collapse" data-target="#faq-collapse{{$key + 1}}" aria-expanded="false" aria-controls="faq-collapse2">
                                                    <span class="button-faq">{{ @$item -> question }}</span>
                                                    <i class="fas fa-sort-down"></i>
                                                </a>
                                            </h5>
                                        </div>
                                        <div id="faq-collapse{{$key + 1}}" class="collapse" aria-expanded="false" role="tabpanel" data-parent="#faq-five">
                                            <div class="panel-body">
                                                <p>{{ @$item -> answer }}</p>
                                                <p>{{ @$item -> description }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <!--// Panel-default -->
                            @endforeach

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- main-content-wrap end -->
@stop
