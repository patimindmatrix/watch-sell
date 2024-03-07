<div class="single-widget mb-30">
    <h4 class="widget-title">Danh Mục</h4>
    <!-- category-widget start -->
    <div class="category-widget-list">
        <ul>
            @foreach($blogCategory as $category)
                <li><a href="{{ route("blog.blogByCategory", ["slug" => $category -> slug]) }}">{{ $category -> name }}</a></li>
            @endforeach
        </ul>
    </div>
    <!-- category-widget end -->
</div>
