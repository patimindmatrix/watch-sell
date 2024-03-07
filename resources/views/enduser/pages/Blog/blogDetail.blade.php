@extends("enduser.layout")
@section("head_meta")
    @include("enduser.meta", [
    "title" => @$blogContent -> name,
    "url" => Request::url(),
    ])
@stop
@section("front_content")
    <!-- breadcrumb-area start -->
    <div class="breadcrumb-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                   @include("enduser.components.breadcrumb", ["currentPage" => "Tin Tuc"])
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb-area end -->

    <!-- main-content-wrap start -->
    <div class="main-content-wrap shop-page section-ptb">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 order-lg-1 order-2">
                    <!-- blog-sidebar-wrap start -->
                    <div class="blog-sidebar-wrap">
                        <div class="blog-sidebar-widget-area">

                            @include("enduser.components.sidebar_blog_category")

                            @include("enduser.components.sidebar_recent_blog")


                        </div>
                    </div>
                    <!-- blog-sidebar-wrap end -->
                </div>
                <div class="col-lg-9 order-lg-2 order-1">

                    <div class="blog-wrapper">
                        <div class="row">
                            <div class="col-lg-12">
                                <!-- single-blog-wrap Start -->
                                <div class="single-blog-wrap mb-40">
                                    <div class="latest-blog-content mt-0">
                                        <h4>Blog image post</h4>
                                        <ul class="post-meta">
                                            <li class="post-author">By <a href="#">{{ @$blogContent -> author }} </a></li>
                                            <li class="post-date">{{ date_format(@$blogContent -> updated_at, "d/m/Y H:i:s") }}</li>
                                        </ul>
                                    </div>
                                    <div class="latest-blog-image">
                                        <a href="">
                                            <img src="{{ \App\Helper\Functions::getImage("blog", $blogContent -> picture) }}" alt="{{ @$blogContent -> name }}">
                                        </a>
                                    </div>
                                    <div class="latest-blog-content mt-20" style="line-height: 2">
                                        <blockquote class="blockquote-box">
                                            <p>{{ @$blogContent -> description }}</p>
                                        </blockquote>
                                        {!! @$blogContent -> content !!}
                                    </div>

                                    <div class="meta-sharing">
                                        <div class="row align-items-center">
                                            <div class="col-lg-6">
                                                <div class="entry-meta mt-15">
                                                    Danh mục: <a href="#">{{ @$category -> name }}</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- single-blog-wrap End -->

                            </div>
                        </div>

                        <div class="related-post-blog-area">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="section-title">
                                        <h4>Bài viết liên quan</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                @foreach($relatedBlog as $blog)
                                    <div class="col-lg-4 col-md-6">
                                    <div class="singel-latest-blog mt-30">
                                        <div class="latest-blog-image">
                                            <a href="{{ route("blog.blogDetail", ["slug" => @$blog -> slug]) }}">
                                                <img src="{{ \App\Helper\Functions::getImage("blog", @$blog -> picture, "thumbnail") }}" alt="">
                                            </a>
                                        </div>
                                        <div class="latest-blog-content mt-20">
                                            <h4>
                                                <a class="articles-name" href="{{ route("blog.blogDetail", ["slug" => @$blog -> slug]) }}"> {{ $blog -> name }}</a>
                                            </h4>
                                            <ul class="post-meta">
                                                <li class="post-date">{{ date_format(@$blog -> updated_at, "d/m/Y H:i:s") }}</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        @include("enduser.components.comment_blog")
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- main-content-wrap end -->
@stop

<style>
    .latest-blog-content h2{
        line-height: 45px;
    }
</style>
