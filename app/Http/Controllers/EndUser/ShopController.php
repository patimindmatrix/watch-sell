<?php

namespace App\Http\Controllers\EndUser;

use App\Http\Controllers\Controller;
use App\Partner;
use App\Product;
use App\Product_category;
use App\Product_tags;
use Illuminate\Http\Request;
use Harimayco\Menu\Facades\Menu;
use phpDocumentor\Reflection\DocBlock\Tag;

class ShopController extends Controller
{
    protected $pathView = "enduser.pages.Shop.";

    public function __construct(){
        $maxValue = Product::max("price_final");
        view() -> share("maxValue", $maxValue);
    }

    public function sort($model){
        $sort = $_GET['loc'];

        //appends là dùng để thêm điều kiện vào route khi phân trang

        if($sort == "none"){
            $products = $model->orderBy('id')->paginate(12);
        }
        elseif ($sort == 'kytu-az') {
            $products = $model->orderBy('name', 'ASC')->paginate(12)->appends(request() -> query());
        }
        elseif ($sort == "kytu-za"){
            $products = $model->orderBy('name', 'DESC')->paginate(12)->appends(request() -> query());
        }
        elseif ($sort == "gia-tang-dan"){
            $products = $model->orderBy('price_final', 'ASC')->paginate(12)->appends(request() -> query());
        }
        elseif ($sort == "gia-giam-dan"){
            $products = $model->orderBy('price_final', 'DESC')->paginate(12)->appends(request() -> query());
        }

        return $products;
    }

    public function index(Request $request){

        //dd($request->minPrice);
        $wishlist = session() -> get("wishList");
        $carts = session() -> get("cart");
        $tags = Product_tags::where('status', 'active')->get();
        $model = Product::where('status', 'active');
        if( !empty($request -> minPrice && $request -> maxPrice)){
            $minPrice = $request -> minPrice;
            $maxPrice = $request -> maxPrice;
            $products = $model -> whereBetween('price_final', [$minPrice, $maxPrice]) -> paginate(12) -> appends(request() -> query());
        }
        else if( isset($request -> loc) && empty($request -> minPrice && $request -> maxPrice) ) {
            $products = $this -> sort($model);
        }else{
            $products = $model->orderBy('id')->paginate(12);
        }

        $categories = Product_category::where('status','active')->get();

        return view($this -> pathView . "shop",
        compact("products", "categories", "carts", "tags", "wishlist"));
    }

    public function searchBrand(Request $request){
        $wishlist = session() -> get("wishList");
        $tags = Product_tags::where('status', 'active')->get();
        $carts = session() -> get("cart");

        if(isset($request['keyword'])){
            $keyword = $request['keyword'];
        }

        $category = Product_category::where("name", "LIKE", "%" . $keyword . "%")->first();

        if($category){
            $model = $category->products()->where("status","active");
            $products = $category ->products()->where("status","active")->paginate(12);
        }
        else{
            $products = [];
        }

        if( !empty($request -> minPrice && $request -> maxPrice)){
            $minPrice = $request -> minPrice;
            $maxPrice = $request -> maxPrice;
            $products = $category -> products()->where("status","active")->whereBetween('price_final', [$minPrice, $maxPrice]) -> paginate(12) -> appends(request() -> query());
        }
        else if(isset($_GET['loc'])){
            $products = $this -> sort($model);
        }


        return view($this -> pathView . "listProductSearched",
            compact("keyword", "products", "carts", "tags", "wishlist"));
    }

    public function productDetail($slug){
        $wishlist = session() -> get("wishList");
        $tags = Product_tags::where('status', 'active')->get();
        $carts = session() -> get("cart");

        if(isset($slug)){
            $single_product = Product::where('slug', $slug)->first();

            //Lấy review của sản phẩm
            $reviews = $single_product -> reviews;
            //dd($reviews);

            $related_products = Product::where('category_id', $single_product -> category_id)->orderBy('id')->get();
        }

        return view($this -> pathView . "productDetail",
            compact("carts","single_product", "related_products", "tags", "wishlist", "reviews"));
    }


    public function showProductByCategory(Request $request, $slug){
        $category = Product_category::where("slug", $slug)->first();

        $wishlist = session() -> get("wishList");
        $tags = Product_tags::where('status', 'active')->get();
        $carts = session() -> get("cart");
        $categories = Product_category::where('status','active')->get();

        $category = Product_category::where("slug", $slug)->first();

        $model = $category->products()->where('status', 'active');

        if( !empty($request -> minPrice && $request -> maxPrice)){
            $minPrice = $request -> minPrice;
            $maxPrice = $request -> maxPrice;
            $products = $model -> whereBetween('price_final', [$minPrice, $maxPrice]) -> paginate(12) -> appends(request() -> query());
        }
        else if(isset($_GET['loc'])) {
            $products = $this -> sort($model);
        }else{
            $products = $model -> paginate(12);
        }

        return view($this -> pathView . "product_category",
        compact("products", "categories", "category", "carts", "tags", "wishlist"));
    }

    public function showProductByTag(Request $request, $slug){
        $wishlist = session() -> get("wishList");
        $tags = Product_tags::where('status', 'active')->get();
        $carts = session() -> get("cart");
        $categories = Product_category::where('status','active')->get();

        $tag = Product_tags::where("slug", $slug)->first();

        $model = $tag->products()->where('status', 'active');

        if( !empty($request -> minPrice && $request -> maxPrice)){
            $minPrice = $request -> minPrice;
            $maxPrice = $request -> maxPrice;
            $products = $model -> whereBetween('price_final', [$minPrice, $maxPrice]) -> paginate(12) -> appends(request() -> query());
        }
        else if(isset($_GET['loc'])) {
            $products = $this -> sort($model);
        }else{
            $products = $model -> paginate(12);
        }

        return view($this -> pathView . "product_tag",
            compact("products", "categories", "tag", "carts", "tags", "wishlist"));
    }

    public function showProductByBrand(Request $request,$slug){
        $wishlist = session() -> get("wishList");
        $tags = Product_tags::where('status', 'active')->get();
        $carts = session() -> get("cart");
        $allPartner = Partner::all();

        $partner = Product_category::where('slug', $slug)->first();

        $model = $partner -> products() -> where('status', 'active');

        if( !empty($request -> minPrice && $request -> maxPrice)){
            $minPrice = $request -> minPrice;
            $maxPrice = $request -> maxPrice;
            $products = $model -> whereBetween('price_final', [$minPrice, $maxPrice]) -> paginate(12) -> appends(request() -> query());
        }
        else if(isset($_GET['loc'])) {
            $products = $this -> sort($model);
        }else{
            $products = $model -> paginate(12);
        }

        return view($this -> pathView . "productsByPartner",
            compact("partner", "allPartner", "products", "carts", "tags", "wishlist"));
    }
}
