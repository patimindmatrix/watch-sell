<form method="GET">
    @csrf
    <div class="shop-top-bar">
        <!-- product-short start -->
        <div class="product-short">
            <p>Sort By :</p>
            <select class="nice-select" name="sortby" id="sortby">
                <option value="{{Request::url()}}?loc=none">- Mặc định -</option>
                <option value="{{Request::url()}}?loc=kytu-az">Tên (A - Z)</option>
                <option value="{{Request::url()}}?loc=kytu-za">Tên (Z - A)</option>
                <option value="{{Request::url()}}?loc=gia-tang-dan">Giá (Thấp > Cao)</option>
                <option value="{{Request::url()}}?loc=gia-giam-dan">Giá (Cao > Thấp)</option>
            </select>
        </div>
        <!-- product-short end -->
    </div>
</form>
