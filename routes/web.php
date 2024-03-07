<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

require("admin.php");

Route::namespace("EndUser")->group(function(){
    Route::get('/', 'PageController@index')->name('page.index');

    /*----- Authentication -----*/
    $prefix = "";
    $controller = "auth";
    Route::prefix($prefix)->name($controller . ".")->group(function () use ($controller){
        $controllerName = ucfirst($controller) . "Controller@";
        Route::get("/dang-nhap", $controllerName . "login")->name("login");
        Route::post("/kiem-tra-dang-nhap", $controllerName . "checkLogin")->name("checkLogin");
        Route::get("dang-ky", $controllerName . "register")->name("register");
        Route::post("kiem-tra-dang-ky", $controllerName . "checkRegister")->name("checkRegister");
        Route::get("dang-xuat", $controllerName . "logout")->name("logout");
        Route::get('login/{provider}', $controllerName.'redirectToProvider')->name("socialLogin");
        Route::get('login/{provider}/callback', $controllerName.'handleProviderCallback')->name("socialLoginCallBack");
        Route::get('forgot-password', $controllerName.'viewForgotPassword')->name("viewForgotPassword");
        Route::get('reset-password/{email}', $controllerName.'viewResetPassword')->name("viewResetPassword");
        Route::post('check-reset-password/{email}', $controllerName.'resetPassword')->name("resetPassword");
        Route::post('change-password/{id}', $controllerName.'changePassword')->name("changePassword");
    });

    /*----- User Profile -----*/
    $prefix = "ca-nhan";
    $controller = "user_profile";
    Route::prefix($prefix)->name($controller . ".")->group(function () use ($controller){
        $controllerName = ucfirst($controller) . "Controller@";
        Route::get('/', $controllerName.'showAccountDetail')->name("showAccountDetail");
        Route::post('update-profile/{id}', $controllerName.'updateProfile')->name("updateProfile");
        Route::get('don-hang-cua-toi', $controllerName.'showUserOrdered')->name("myOrder");
        Route::get('don-hang-cua-toi/{id}', $controllerName.'showOrderDetail')->name("orderDetail");
        Route::post('cancel-order/{id}', $controllerName.'cancelOrder')->name("cancelOrder");
    });

    /*----- Cua Hang -----*/
    $prefix = "cua-hang";
    $controller = "shop";
    Route::prefix($prefix)->name($controller . ".")->group(function () use ($controller){
        $controllerName = ucfirst($controller) . "Controller@";
        Route::get("/", $controllerName . "index")->name("index");
        Route::get("san-pham={slug}", $controllerName . "productDetail")->name("productDetail");
        Route::get("danh-muc={slug}", $controllerName . "showProductByCategory")->name("showProductByCategory");
        Route::get("tag={slug}", $controllerName . "showProductByTag")->name("showProductByTag");
        Route::get("tim-kiem", $controllerName . "searchBrand")->name("searchBrand");
        Route::get("thuong-hieu/{slug}", $controllerName . "showProductByBrand")->name("showProductByBrand");
    });

    /*----- Gio Hang -----*/
    $prefix = "gio-hang";
    $controller = "cart";
    Route::prefix($prefix)->name($controller . ".")->group(function () use ($controller){
        $controllerName = ucfirst($controller) . "Controller@";
        Route::get('/', $controllerName . "showCart")->name("showCart");
        Route::get('them-san-pham/{id}', $controllerName . "addToCart")->name("addToCart");
        Route::get('them-gio-hang/{id}', $controllerName . "addCartForDetailProduct")->name("addCartForDetailProduct");
        Route::get('cap-nhat', $controllerName . "updateCart")->name("updateCart");
        Route::get('xoa-san-pham', $controllerName . "deleteProduct")->name("deleteProduct");
        Route::get('ap-dung-coupon', $controllerName . "applyCoupon")->name("applyCoupon");
        Route::get('kiem-tra-so-luong/{product}', $controllerName . "checkProductQuantity")->name("checkProductQuantity");
    });

    /*----- WishList -----*/
    $prefix = "danh-sach-yeu-thich";
    $controller = "wishList";
    Route::prefix($prefix)->name($controller . ".")->group(function () use ($controller){
        $controllerName = ucfirst($controller) . "Controller@";
        Route::get("them-danh-sach-yeu-thich/{id}", $controllerName."addWishList")->name("addWishList");
        Route::get("/", $controllerName."showWishList")->name("showWishList");
        Route::get("xoa-san-pham-yeu-thich", $controllerName."deleteWishProduct")->name("deleteWishProduct");
    });

    /*----- Thanh Toan -----*/
    $prefix = "thanh-toan";
    $controller = "checkout";
    Route::prefix($prefix)->name($controller . ".")->group(function () use ($controller){
        $controllerName = ucfirst($controller) . "Controller@";
        Route::get('/', $controllerName."checkLoginToCheckOut")->name("checkLoginToCheckOut");
        Route::post('get-district', $controllerName."getDistrict")->name("getDistrict");
        Route::post('get-ward', $controllerName."getWard")->name("getWard");
        Route::post('applyCoupon', $controllerName."applyCoupon")->name("applyCoupon");
        Route::post('confirmCheckout', $controllerName."confirmCheckout")->name("confirmCheckout");
        Route::get('ghi-nhan-don-hang/{id}', $controllerName."checkoutSuccess")->name("checkoutSuccess");
    });

    /*----- Blog -----*/
    $prefix = "tin-tuc";
    $controller = "blog";
    Route::prefix($prefix)->name($controller . ".")->group(function () use ($controller){
        $controllerName = ucfirst($controller) . "Controller@";
        Route::get("/", $controllerName."index")->name("index");
        Route::get("danh-muc={slug}", $controllerName."blogByCategory")->name("blogByCategory");
        Route::get("/{slug}", $controllerName."blogDetail")->name("blogDetail");
    });

    /*----- Comment -----*/
    $prefix = "binh-luan";
    $controller = "comment";
    Route::prefix($prefix)->name($controller . ".")->group(function () use ($controller){
        $controllerName = ucfirst($controller) . "Controller@";
        Route::post("store/{id}", $controllerName."store")->name("store");
        Route::post("store-reply", $controllerName."replyComment")->name("replyComment");
        Route::post("sua-binh-luan/{id}", $controllerName."editComment")->name("editComment");
        Route::get("xoa-binh-luan/{id}", $controllerName."deleteComment")->name("deleteComment");
    });

    /*----- Review -----*/
    $prefix = "danh-gia-san-pham";
    $controller = "review";
    Route::prefix($prefix)->name($controller . ".")->group(function () use ($controller){
        $controllerName = ucfirst($controller) . "Controller@";
        Route::post("{id}", $controllerName."storeReview")->name("storeReview");
        Route::post("sua-danh-gia/{id}", $controllerName."editReview")->name("editReview");
        Route::get("xoa-danh-gia/{id}", $controllerName."deleteReview")->name("deleteReview");
    });

    /*----- Send Email -----*/
    $prefix = "";
    $controller = "sendEmail";
    Route::prefix($prefix)->name($controller . ".")->group(function () use ($controller){
        $controllerName = ucfirst($controller) . "Controller@";
        Route::post("mail-to-retrieve-password", $controllerName."mailToRetrievePassword")->name("mailToRetrievePassword");
        Route::post("mail-to-message", $controllerName."mailToMessageAdmin")->name("mailToMessageAdmin");
    });

    /*----- Frequently Questions -----*/
    $prefix = "cau-hoi-thuong-gap";
    $controller = "faq";
    Route::prefix($prefix)->name($controller . ".")->group(function () use ($controller){
        $controllerName = ucfirst($controller) . "Controller@";
        Route::get("/", $controllerName."index")->name("index");
    });

    /*----- Contact -----*/
    $prefix = "lien-he";
    $controller = "contact";
    Route::prefix($prefix)->name($controller . ".")->group(function () use ($controller){
        $controllerName = ucfirst($controller) . "Controller@";
        Route::get("/", $controllerName."index")->name("index");
    });

});

