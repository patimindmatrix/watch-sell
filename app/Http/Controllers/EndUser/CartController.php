<?php

namespace App\Http\Controllers\EndUser;

use App\Coupon;
use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    protected $pathView = "enduser.pages.Cart.";

    public function showCart(){
        $data["wishlist"] = session() -> get("wishList");
        $data["carts"] = session() -> get("cart");
        return view($this -> pathView . "cart")->with($data);
    }

    public function addToCart($id){

        $product = Product::find($id);

        $cart = session() -> get("cart");

        if(isset($cart[$id])){
            $cart[$id]["quantity"]++;
        }
        else{
            $cart[$id] = [
                "id" => $product -> id,
                "name" => $product -> name,
                "picture" => $product -> picture,
                "subtotal" => $product -> price_final,
                "quantity" => 1,
                "slug" => $product -> slug,
                "category" => $product -> categories -> slug
            ];
        }

        session() -> put("cart", $cart);

        return response() -> json([
            "code" => 200,
            "message" => "success",
        ], 200);
    }


    public function addCartForDetailProduct(Request $request, $id){
        $cart = session() -> get("cart");
        $product = Product::find($id);

        if(isset($cart[$id])){
            $cart[$id]["quantity"] += $request["quantity"];
        }
        else{
            $cart[$id] = [
                "id" => $product -> id,
                "name" => $product -> name,
                "picture" => $product -> picture,
                "subtotal" => $product -> price_final,
                "quantity" => $request['quantity'],
                "slug" => $product -> slug,
                "category" => $product -> categories -> slug
            ];
        }

        session() -> put("cart", $cart);

        return response() -> json([
            "code" => 200,
            "message" => "success",
        ], 200);
    }

    public function checkProductQuantity(Product $product, Request $request) {
        $cart = session()->get("cart");
        $quantityInput = $request->get('amount');
        $totalPrice = 0;
        if ( isset($cart[$product->id]) && $request->get('isCheckCart') == "true" ) {
            $quantityInput += $cart[$product->id]["quantity"];
        }

        if ( $product->amount < $quantityInput ) {
            return response() -> json([
                "code" => false,
                "message" => "failure",
                "product" => $product,
            ], 200);
        } else if ( $request->get('isCheckCart') == "false" ) {
            $cart[$product->id]["quantity"] = $quantityInput;
            session() -> put("cart", $cart);
            foreach ($cart as $c) {
                $totalPrice += $c["quantity"] * $c["subtotal"];
            }
        }

        return response() -> json([
            "code" => true,
            "message" => "success",
            "product" => $product,
            "totalPrice" => $totalPrice
        ], 200);
    }

    public function updateCart(Request $request){
        $getAllProduct = session() -> get("cart");

        if( isset($request["data"]) ){
            $array = $request["data"];
            foreach ($array as $product) {
                $getAllProduct[$product["id"]]["quantity"] = $product["quantity"];
                session() -> put("cart", $getAllProduct);
            }

            $carts = session() -> get("cart");
            $cartsView = view("enduser.components.carts", compact("carts")) -> render();
            return response() -> json([
                "code" => 200,
                "data" => $cartsView
            ], 200);
        }
    }

    public function deleteProduct(Request $request){
        $getCarts = session() -> get("cart");

        if($request["id"]){
            unset($getCarts[$request["id"]]);
            //Sau khi xoa thi update lai cart
            session() -> put("cart", $getCarts);

            $carts = session() -> get("cart");

            $cartsView = view("enduser.components.carts", compact("carts")) -> render();

            return response() -> json([
                "code" => 200,
                "data" => $cartsView
            ], 200);
        }
    }

    public function checkout(){
        return view($this -> pathView . "checkout");
    }

    public function applyCoupon(Request $request){
        $data['carts'] = session() -> get("cart");

        if(isset($request -> nameCoupon)){
            $data["coupon"] = Coupon::where('name', $request -> nameCoupon)->first();
            $cartsView = view("enduser.components.carts") -> with($data) -> render();
            return response() -> json([
                'data' => $cartsView,
                'code' => 200
            ],200);
        }
    }
}
