@extends("enduser.layout")
@section("head_meta")
    @php
        if(isset($category)){
            $title = $category -> name;
        }
        else{
            $title = "Kinh nghiệm, cẩm nang";
        }
    @endphp
    @include("enduser.meta", [
    "title" => $title,
    "url" => Request::url(),
    ])
@stop
@section("front_content")
    <!-- breadcrumb-area start -->
    <div class="breadcrumb-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    @include("enduser.components.breadcrumb", ["currentPage" => "Tin Tức"])
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb-area end -->

    <!-- main-content-wrap start -->
    <div class="main-content-wrap blog-page">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 order-lg-1 order-2">
                    <!-- blog-sidebar-wrap start -->
                    <div class="blog-sidebar-wrap section-pt" style="padding-bottom: 50px">
                        <div class="blog-sidebar-widget-area">

                           @include("enduser.components.sidebar_blog_category")

                            @include("enduser.components.sidebar_recent_blog")

                        </div>
                    </div>
                    <!-- blog-sidebar-wrap end -->
                </div>
                <div class="col-lg-9 order-lg-2 order-1">

                    <div class="blog-wrapper section-pt">
                        <div class="row">
                            @foreach($blogs as $blog)
                                <div class="col-lg-6 col-md-6">
                                <div class="singel-latest-blog">
                                    <div class="articles-image">
                                        <a href="{{ route("blog.blogDetail", ["slug" => @$blog -> slug]) }}">
                                            <img src="{{ \App\Helper\Functions::getImage("blog", @$blog -> picture) }}" alt="">
                                        </a>
                                    </div>
                                    <div class="aritcles-content">
                                        <div class="author-name">
                                            post by: <a href="#"> {{ @$blog -> author }}</a> - {{ @$blog -> updated_at }}
                                        </div>
                                        <h4>
                                            <a href="{{ route("blog.blogDetail", ["slug" => @$blog -> slug]) }}" class="articles-name">
                                                {{ @$blog -> name }}
                                            </a>
                                        </h4>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>

                        @include("enduser.components.pagination", ["pagination" => @$blogs])
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- main-content-wrap end -->
@stop
