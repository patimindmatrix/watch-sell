<?php

namespace App\Http\Controllers\EndUser;

use App\Banner;
use App\Blog;
use App\Http\Controllers\Controller;
use App\Partner;
use App\Product;
use Harimayco\Menu\Facades\Menu;
use Illuminate\Http\Request;

class PageController extends Controller
{
    protected $pathView = "enduser.pages.";

    public function index()
    {
        $carts = session() -> get("cart");
        $wishlist = session() -> get("wishList");
        $blogs = Blog::where("status","active")->latest()->limit(3)->get();
        $slidebars = Banner::where([
            ['status', 'active'],
            ['type' , '1'],
            ['location', 'Trang chủ']
        ])->orderBy('id')->limit(2)->get();

        $banner_below_slidebar = Banner::where([
            ['status', 'active'],
            ['type' , '0'],
            ['location', 'trang chủ - dưới slidebar']
        ])->orderBy('id')->limit(2)->get();

        $best_seller = Product::where([
            ['status','active'],
            ['type','bán chạy'],
            ['amount', '>', 0]
        ])->limit(10)->latest()->get();

        $banners = Banner::where([
            ['status', 'active'],
            ['type' , '0'],
            ['location', 'trang chủ']
        ])->limit(2)->get();

        $partners = Partner::where('status', 'active')->get();

        $product_sale = Product::where([
            ['status' , 'active'],
            ['type','giảm giá'],
            ['amount', '>', 0]
        ])->limit(10)->latest()->get();

        return view($this -> pathView . "index"
        ,compact("slidebars", "banner_below_slidebar",
                "partners", "best_seller", "banners", "product_sale", "carts", "wishlist", "blogs"));
    }
}
