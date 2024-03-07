<div class="shop-sidebar mb-30">
    <h4 class="title">Nhãn</h4>

    <ul class="sidebar-tag">
        @foreach($tags as $tag)
            <li><a href="{{ route("shop.showProductByTag", ["slug" => $tag -> slug]) }}">{{ $tag -> name }}</a></li>
        @endforeach
    </ul>

</div>
