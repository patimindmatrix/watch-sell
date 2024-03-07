<?php

namespace App\Http\Controllers\EndUser;

use App\User;
use App\User as MainModel;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    protected $pathView = "enduser.pages.Auth.";
    protected $model;
    protected $remove = ["_token", "password_confirmation"];


    public function __construct(){
        $this -> model = new MainModel();
    }

    public function login(){

        //Check nếu url previous là trang reset password thì setIntendedUrl sẽ là trang cá nhân
        if( strpos(url() -> previous(), "reset-password") ){
            Redirect::setIntendedUrl("http://localhost/ca-nhan");
        }
        else{
            Redirect::setIntendedUrl(url()->previous());
        }

        return view($this -> pathView . "login");
    }

    public function checkLogin(Request $request){
        $email = $request -> email;
        $password = $request -> password;
        $remember_me = $request -> has("remember_me") ? true : false;

        if( Auth::attempt(["email" => $email, "password" => $password], $remember_me) ){
            //dùng RouteServiceProvider để lấy session từ intended đã thêm
            $user = Auth::user();
            return redirect() -> intended(RouteServiceProvider::HOME);
        }

        else{
            Session::flash("login_failed", "Tài khoản hoặc mật khẩu không đúng !");
            return redirect() -> route("auth.login");;
        }

    }

    public function register(){
        return view($this -> pathView . "register");
    }

    public function checkRegister(Request $request){
        $this -> validateForm($request);

        $data = $this -> getData($request -> all());

        foreach ($data as $key => $value){
            if($key == "password"){
                $value = Hash::make($value);
            }

            $this -> model -> $key = $value;
        }

        $this -> model -> save();
        $this -> checkLogin($request);
        return redirect() -> intended(RouteServiceProvider::HOME);
    }

    public function logout(){
        Auth::logout();
        return redirect() -> route("auth.login");
    }

    public function getData($request){
        return array_diff_key($request, array_flip($this -> remove));
    }

    public function validateForm(Request $request){
        $validate = $request -> validate([
            "user_name" => "required",
            // confirmed work khi name của input nhập lại mật khẩu có name là password_confirmation
            "password" => "required|min:8|confirmed",
            "phone" => "required",
            "email" => "required",

        ],[
            "required" => ":attribute không được để trống",
            "min" => ":attribute ít nhất 8 kí tự",
            "email" => ":attribute phải là kiểu email '@' ",
            "unique" => ":attribute đã tồn tại",
            "confirmed" => ":attribute không khớp",

        ],[
            "user_name" => "Tên",
            "password" => "Mật khẩu",
            "phone" => "Số điện thoại",
            "email" => "Email",

        ]);

        return $validate;
    }

    //Login with Socialite
    public function redirectToProvider(string $provider){
        return Socialite::driver($provider)->redirect();
    }

    public function handleProviderCallback(string $provider){
        $user = Socialite::driver($provider)->user();
        //dd($user);
        $this -> registerOrLoginUserSocialite($user);
        return redirect() -> intended(RouteServiceProvider::HOME);
    }

    public function registerOrLoginUserSocialite($data){
        $user = MainModel::where("email", "=", $data -> email)->first();
        //dd($user);
        if(!$user){
            $user = new MainModel();
            $user->user_name = $data->name;
            $user->email = $data->email;
            $user->picture = $data->avatar;
            $user->provider_id = $data->id;
            $user->save();
        }

        Auth::login($user);
    }

    public function viewForgotPassword(){
        return view($this -> pathView. "forgot_password");
    }

    public function viewResetPassword($email){
        $user_email = $email;
        //dd($user_email);
        return view($this -> pathView. "reset_password",compact('user_email'));
    }

    public function resetPassword(Request $request, $email){
        //decode email after encode
        $decodeEmail = base64_decode($email);

        $validator = $this -> validatePassword($request -> all());

        if($validator -> passes()){

            //Nếu như chưa có email thì sẽ tạo 1 tài khoản mới
            $user_account = User::where("email", $decodeEmail) -> first();
            if(!$user_account){
                $user_account = new User();
                $user_account -> email = $decodeEmail;
                $user_account -> password = Hash::make($request -> password);
                $user_account -> save();
            }

            //Nếu tồn tài tài khoản mang email trên thì thay đổi mật khẩu
            else{
                $user_account -> password = Hash::make($request -> password);
                $user_account -> save();
            }

            return response() -> json([
                'code' => 200,
                'success' => 'Đổi mật khẩu thành công',

            ],200);

        }
        else{
            return response() -> json([
                'error' => $validator -> errors() -> all(),
            ]);
        }
    }

    public function changePassword(Request $request, $id){
        $user = User::find($id);

        if($user){
            $request -> validate([
                'password' => 'bail|required|confirmed|min:8'
            ],[
                'required' => ':attribute không được rỗng',
                'confirmed' => ':attribute không khớp',
                'min' => ':attribute ít nhất 8 kí tự'
            ],[
                'password' => 'Mật khẩu',
            ]);

            if( Hash::check($request -> old_password, $user -> password) ){
                $user -> password = Hash::make($request -> password);
                $user -> save();
                Session::flash("changePassword", "Đổi mật khẩu thành công");
                return back();
            }

            else{
                Session::flash("error_password", "Mật khẩu không đúng");
                return back();
            }
        }
    }

    public function validatePassword($request){
        $validate = Validator::make($request,[
            'password' => 'bail|required|confirmed|min:8'
        ],[
            'required' => ':attribute không được rỗng',
            'confirmed' => ':attribute không khớp',
            'min' => ':attribute ít nhất 8 kí tự'
        ],[
            'password' => 'Mật khẩu',
        ]);

        return $validate;
    }

}
