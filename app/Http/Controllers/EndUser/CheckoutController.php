<?php

namespace App\Http\Controllers\EndUser;

use App\Bank;
use App\Coupon;
use App\District;
use App\Http\Controllers\Controller;
use App\Order;
use App\OrderAddress;
use App\OrderDetail;
use App\Province;
use App\Ward;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    protected $pathView = "enduser.pages.Checkout.";

    public function checkLoginToCheckOut(){
        if( !Auth::check() ){
            return redirect() -> route("auth.login");
        }
        else if ( empty(session()->get("cart")) ) {
            return redirect()->back();
        }
        else {
            $data["wishlist"] = session() -> get("wishList");
            $data["carts"] = session()->get("cart");
            $data["provinces"] = Province::orderBy("_name", "ASC")->get();
            $data["banks"] = Bank::where("status", "active")->get();

            //dd($data["provinces"]);
            return view($this -> pathView . "checkout")->with($data);
        }
    }

    public function getDistrict(){
        if($_POST["province_id"]){
            $province_id = $_POST["province_id"];
            $districts = District::where("_province_id", $province_id)->get();

            return response() -> json([
                "code" => 200,
                "data" => $districts,
            ],200);
        }
    }

    public function getWard(){

        if($_POST["district_id"]){
            $district_id = $_POST["district_id"];
            $wards = Ward::where("_district_id", $district_id)->get();

            return response() -> json([
                "code" => 200,
                "data" => $wards,
            ],200);
        }
    }

    public function confirmCheckout(Request $request){
        if(!empty($request['coupon_id'])){
            $coupon = Coupon::where("name", $request['coupon_id'])->first();
        }

        $user_id = Auth::user()->id;
        $data = $request -> all();
        //dd($request -> all());

        //Store data into order, order_detail table
        $order_address = new OrderAddress();
        $order_address -> user_id = $user_id;

        $order = new Order();
        $order -> user_id = $user_id;

        foreach ($data as $key => $value){
            if($key == "pay_method" || $key == "note" || $key == "price_total"){
                $order -> $key = $value;
            }
            else if($key == "bank"){
                unset($key);
            }
            else if($key == "coupon_id"){
                $order -> $key = @$coupon -> id;
            }
            else{
                if($key == "province"){
                    $province_name = Province::find($value);
                    $value = $province_name -> _name;
                }
                if($key == "district"){
                    $district_name = District::find($value);
                    $value = $district_name -> _name;
                }
                if($key == "ward"){
                    $ward_name = Ward::find($value);
                    $value = $ward_name -> _name;
                }
                $order_address -> $key = $value;
            }

        }

        $order_address -> save();

        //Save address id after store order_address into database
        $order -> address_id = $order_address -> id;
        $order -> save();

        $cart_detail = session() -> get("cart");
        //Store data into order_detail table
        foreach ($cart_detail as $product_id){
            $order_detail = new OrderDetail();
            $order_detail -> user_id = $user_id;
            $order_detail -> order_id = $order -> id;
            $order_detail -> product_id = $product_id['id'];
            $order_detail -> product_name = $product_id['name'];
            $order_detail -> product_picture = $product_id['picture'];
            $order_detail -> product_price = $product_id['subtotal'];
            $order_detail -> product_quantity = $product_id['quantity'];
            $order_detail -> price_total = $product_id['subtotal'] * $product_id['quantity'];
            $order_detail -> status = 'Đang chờ xử lý';
            $order_detail -> save();
        }

        return response() -> json([
            'code' => 200,
            'orderId' => $order -> id,
        ],200);

    }

    public function applyCoupon(Request $request){
        $couponActive = Coupon::where("name", $request -> nameCoupon)->first();
        if(isset($couponActive)){
            return response() -> json([
                'code' => 200,
                'data' => $couponActive,
            ],200);
        }
        else{
            return response() -> json([
                'code' => 500,
            ]);
        }
    }

    public function checkoutSuccess($id){
        $data['wishlist'] = session() -> get("wishList");
        //Xoá card sau khi thanh toán
        session() -> forget("cart");
        $data['carts'] = session() -> get("cart");

        //Lấy order với id truyền lên
        $data['order'] = Order::find($id);
        //Lấy order detail vs id order
        $data['order_details'] = $data['order'] -> orderDetails;
        //Lấy thông tin banks
        $data['banks'] = Bank::where("status","active")->get();

        return view($this -> pathView ."doneCheckout")->with($data);
    }


}
