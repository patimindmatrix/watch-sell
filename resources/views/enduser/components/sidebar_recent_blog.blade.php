<div class="single-widget mb-30">
    <h4 class="widget-title">Bài viết gần đây</h4>

    <div class="recent-post-widget">
        @foreach($recentBlog as $blog)
            <div class="single-widget-post">
                <div class="post-thumb">
                    <a href="{{ route("blog.blogDetail", ["slug" => @$blog -> slug]) }}">
                        <img src="{{ \App\Helper\Functions::getImage("blog", @$blog -> picture) }}" alt="">
                    </a>
                </div>
                <div class="post-info">
                    <h6 class="post-title">
                        <a href="{{ route("blog.blogDetail", ["slug" => @$blog -> slug]) }}" class="articles-name">
                            {{ @$blog -> name }}
                        </a>
                    </h6>
                    <div class="post-date">{{ date_format(@$blog -> updated_at, "d/m/Y H:i:s") }}</div>
                </div>
            </div>
        @endforeach
    </div>

</div>
