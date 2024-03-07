<?php

namespace App\Http\Controllers\EndUser;

use App\Http\Controllers\Controller;
use App\Order;
use App\OrderAddress;
use App\OrderDetail;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class User_profileController extends Controller
{
    protected $pathView = "enduser.pages.Account.";

    public function showAccountDetail(){
        $data['wishlist'] = session() -> get("wishList");
        $data['carts'] = session() -> get("cart");
        if(Auth::check()){
            $data['user_profile'] = Auth::user();

            //Lấy địa chỉ đặt hàng gần nhất của user
            $order = Order::where("user_id", $data['user_profile'] -> id)->first();

            if(!empty($order)){
                $data['user_address'] = OrderAddress::where("id", $order -> address_id)->first();
            }else{
                $data['user_address'] = [];
            }

        }

        return view($this -> pathView . "layout")->with($data);
    }

    public function showUserOrdered(){
        $data['wishlist'] = session() -> get("wishList");
        $data['carts'] = session() -> get("cart");
        $user = Auth::user();
        $order = Order::where("user_id", $user -> id)->get();

        //Lấy orderDetails theo user id
        $data['orders'] = Order::where("user_id", $user -> id)->paginate(10);
        //dd($data['order_details']);

        //dd(count($data['order_details']));
        return view($this -> pathView . "layout")->with($data);
    }

    public function showOrderDetail($id){
        $data['wishlist'] = session() -> get("wishList");
        $data['carts'] = session() -> get("cart");
        $data['order_id'] = $id;
        $data['order'] = Order::where("id", $id)->first();
        if ( $data['order'] ) {
            $data['order_details'] = $data['order']->orderDetails()->get();
            $data['user_address'] = OrderAddress::where("id", $data['order'] -> address_id)->first();
        }
//        dd($data['order-details']);

        return view($this -> pathView . "layout")->with($data);
    }

    public function updateProfile(Request $request, $id){
        $user = User::find($id);

        if($user){
            $user -> user_name = $request -> user_name;
            $user -> date = $request -> date;
            $user -> phone = $request -> phone;
            $user -> save();

            return response() -> json([
                'code' => 200,
                'data' => $user,
            ], 200);
        }
    }

    public function cancelOrder($id) {
        $order = Order::find($id);
        // 1: cập nhật trạng thái của order theo id --> Hủy
        // 2: cập nhật trạng thái của order_details theo id của order --> Hủy
        $order->update([
            'status' => 'Hủy'
        ]);
        $order->orderDetails()->update([
            'status' => 'Hủy'
        ]);
        return response() -> json([
            'code' => 200,
            'data' => 'success',
        ]);
    }
}
