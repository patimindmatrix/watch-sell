<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    protected $pathView = "auth.core.";

    public function login(){
        return view($this -> pathView . "login");
    }

    public function authenticate(Request $request){
        try{
            $email = $request -> email;
            $password = $request -> password;
            $remember = $request -> has('remember_token') ? true : false;

            if(Auth::attempt(['email' => $email, 'password' => $password], $remember)){
                return response() -> json([
                    'code' => 200,
                    'message' => 'Đăng nhập thành công',
                ], 200);
            }
            else{
                return response() -> json([
                    'code' => 500,
                    'message' => 'Đăng nhập thất bại'
                ], 500);
            }
        }
        catch (\Exception $e){
            $e -> getMessage();
        }
    }
    public function logout(){
        Auth::logout();
        return redirect() -> route("authAdmin.login");
    }
}
