
<div class="row our-brand-active">
    @foreach($partners as $partner)
        <div class="brand-single-item d-flex align-items-center justify-content-center">
            <a href="{{ route("shop.showProductByBrand", ['slug' => $partner -> slug]) }}">
                <img src="{{ \App\Helper\Functions::getImage("partner", $partner -> picture, "thumbnail") }}" alt="">
            </a>
        </div>
    @endforeach
</div>
