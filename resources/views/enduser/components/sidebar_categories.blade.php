<div class="sidebar-categores-box shop-sidebar mb-30">
    <h4 class="title">Danh mục sản phẩm</h4>
    <div class="category-sub-menu">
        <ul>
            @foreach($categories as $category)
                @php
                    $amount = $category -> products;
                @endphp
                <li class="mb-3">
                    <a href="{{ route("shop.showProductByCategory", ["slug" => $category -> slug]) }}">{{ $category -> name }} ({{ count($amount) }})</a>
                </li>
            @endforeach
        </ul>
    </div>
</div>
