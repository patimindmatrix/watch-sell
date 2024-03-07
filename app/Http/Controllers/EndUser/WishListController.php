<?php

namespace App\Http\Controllers\EndUser;

use App\Http\Controllers\Controller;
use App\Product_tags;
use Illuminate\Http\Request;
use App\Product;

class WishListController extends Controller
{
    protected $pathView = "enduser.pages.WishList.";
    protected $viewComponent = "enduser.components.";

    public function showWishList(){
        $data['wishlist'] = session() -> get("wishList");
        $data['carts'] = session() -> get("cart");
        return view($this -> pathView . "show")->with($data);
    }

    public function addWishList($id){
        $wishList = session() -> get("wishList");
        $products = Product::find($id);

        if($id){
            $wishList[$id] = [
                'id' => $products -> id,
                'name' => $products -> name,
                'amount'=> $products->amount,
                'price' => $products -> price_final,
                'picture' => $products -> picture,
                'slug' => $products -> slug
            ];

            session() -> put("wishList", $wishList);
        }

        return response() -> json([
            "code" => 200,
            "count_wishlist" => count($wishList),
        ],200);
    }

    public function deleteWishProduct(Request $request){
        $getWishList = session()->get("wishList");

        if($request['id']){

            unset($getWishList[$request['id']]);
            session() -> put("wishList",$getWishList);

            $wishlist = session()->get("wishList");
            $wishlistView = view($this -> viewComponent . "wishlist",compact("wishlist"))->render();

            return response() -> json([
                'code' => 200,
                'data' => $wishlistView,
                'count_wishlist' => count($wishlist),
            ],200);
        }
    }
}
