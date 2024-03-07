<?php
/*------ Auth ------*/
Route::prefix("auth")->name("authAdmin.")->group(function (){
    $controller = "AuthController@";
    Route::get("/login", $controller . "login")->name("login");
    Route::post("/authenticate", $controller . "authenticate")->name("authenticate");
    Route::get("/logout", $controller . "logout")->name("logout");
});

/*------ Admin ------*/
Route::namespace("Admin")->prefix("admin")->middleware('auth')->name("admin.")->group(function (){

    /*------ Thống kê Routes ------*/
    $prefix = "statistical";
    $controller = "statistical";
    Route::prefix($prefix)->name($controller . ".")->group(function () use($controller){
        $controllerName = ucfirst($controller) . "Controller@";
        Route::get("/", $controllerName . "index")->middleware("can:" . $controller . ".index")->name("index");
    });

    /*------ Product Routes ------*/
    $prefix = "product";
    $controller = "product";
    Route::prefix($prefix)->name($controller . ".")->group(function () use($controller){
        $controllerName = ucfirst($controller) . "Controller@";
        Route::get("/", $controllerName . "index")->middleware("can:" . $controller . ".index")->name("index");
        Route::get("create", $controllerName . "create")->middleware("can:" . $controller . ".create")->name("create");
        Route::post("store", $controllerName . "store")->middleware("can:" . $controller . ".create")->name("store");
        Route::get("edit/{id}", $controllerName . "edit")->middleware("can:" . $controller . ".edit")->name("edit");
        Route::post("update/{id}", $controllerName . "update")->middleware("can:" . $controller . ".edit")->name("update");
        Route::get("delete/{id}", $controllerName . "delete")->middleware("can:" . $controller . ".delete")->name("delete");
        Route::get("delete-review/{id}", $controllerName . "deleteReview")->middleware("can:" . $controller . ".delete")->name("deleteReview");
    });

    /*------ Product Category ------*/
    $prefix = "product_category";
    $controller = "product_category";
    Route::prefix($prefix)->name($controller . ".")->group(function () use($controller){
        $controllerName = ucfirst($controller) . "Controller@";
        Route::get("/", $controllerName . "index")->middleware("can:" . $controller . ".index")->name("index");
        Route::get("create", $controllerName . "create")->middleware("can:" . $controller . ".create")->name("create");
        Route::post("store", $controllerName . "store")->middleware("can:" . $controller . ".create")->name("store");
        Route::get("edit/{id}", $controllerName . "edit")->middleware("can:" . $controller . ".edit")->name("edit");
        Route::post("update/{id}", $controllerName . "update")->middleware("can:" . $controller . ".edit")->name("update");
        Route::get("delete/{id}", $controllerName . "delete")->middleware("can:" . $controller . ".delete")->name("delete");
    });

    /*------ Product Tags ------*/
    $prefix = "product_tags";
    $controller = "product_tags";
    Route::prefix($prefix)->name($controller . ".")->group(function () use($controller){
        $controllerName = ucfirst($controller) . "Controller@";
        Route::get("/", $controllerName . "index")->middleware("can:" . $controller . ".index")->name("index");
        Route::get("create", $controllerName . "create")->middleware("can:" . $controller . ".create")->name("create");
        Route::post("store", $controllerName . "store")->middleware("can:" . $controller . ".create")->name("store");
        Route::get("edit/{id}", $controllerName . "edit")->middleware("can:" . $controller . ".edit")->name("edit");
        Route::post("update/{id}", $controllerName . "update")->middleware("can:" . $controller . ".edit")->name("update");
        Route::get("delete/{id}", $controllerName . "delete")->middleware("can:" . $controller . ".delete")->name("delete");
    });

    /*------ Settings ------*/
    $prefix = "setting";
    $controller = "setting";
    Route::prefix($prefix)->name($controller . ".")->group(function () use($controller){
        $controllerName = ucfirst($controller) . "Controller@";
        Route::get("/", $controllerName . "index")->middleware("can:" . $controller . ".index")->name("index");
        Route::get("create", $controllerName . "create")->middleware("can:" . $controller . ".create")->name("create");
        Route::post("store", $controllerName . "store")->middleware("can:" . $controller . ".create")->name("store");
        Route::get("edit/{id}", $controllerName . "edit")->middleware("can:" . $controller . ".edit")->name("edit");
        Route::post("update/{id}", $controllerName . "update")->middleware("can:" . $controller . ".edit")->name("update");
        Route::get("delete/{id}", $controllerName . "delete")->middleware("can:" . $controller . ".delete")->name("delete");
    });

    /*------ User ------*/
    $prefix = "user";
    $controller = "user";
    Route::prefix($prefix)->name($controller . ".")->group(function () use($controller){
        $controllerName = ucfirst($controller) . "Controller@";
        Route::get("/", $controllerName . "index")->middleware("can:" . $controller . ".index")->name("index");
        Route::get("create", $controllerName . "create")->middleware("can:" . $controller . ".create")->name("create");
        Route::post("store", $controllerName . "store")->middleware("can:" . $controller . ".create")->name("store");
        Route::get("edit/{id}", $controllerName . "edit")->middleware("can:" . $controller . ".edit")->name("edit");
        Route::post("update/{id}", $controllerName . "update")->middleware("can:" . $controller . ".edit")->name("update");
        Route::get("delete/{id}", $controllerName . "delete")->middleware("can:" . $controller . ".delete")->name("delete");
    });

    /*------ Role ------*/
    $prefix = "role";
    $controller = "role";
    Route::prefix($prefix)->name($controller . ".")->group(function () use($controller){
        $controllerName = ucfirst($controller) . "Controller@";
        Route::get("/", $controllerName . "index")->middleware("can:" . $controller . ".index")->name("index");
        Route::get("create", $controllerName . "create")->middleware("can:" . $controller . ".create")->name("create");
        Route::post("store", $controllerName . "store")->middleware("can:" . $controller . ".create")->name("store");
        Route::get("edit/{id}", $controllerName . "edit")->middleware("can:" . $controller . ".edit")->name("edit");
        Route::post("update/{id}", $controllerName . "update")->middleware("can:" . $controller . ".edit")->name("update");
        Route::get("delete/{id}", $controllerName . "delete")->middleware("can:" . $controller . ".delete")->name("delete");
    });

    /*------ Partner ------*/
    $prefix = "partner";
    $controller = "partner";
    Route::prefix($prefix)->name($controller . ".")->group(function () use($controller){
        $controllerName = ucfirst($controller) . "Controller@";
        Route::get("/", $controllerName . "index")->middleware("can:" . $controller . ".index")->name("index");
        Route::get("create", $controllerName . "create")->middleware("can:" . $controller . ".create")->name("create");
        Route::post("store", $controllerName . "store")->middleware("can:" . $controller . ".create")->name("store");
        Route::get("edit/{id}", $controllerName . "edit")->middleware("can:" . $controller . ".edit")->name("edit");
        Route::post("update/{id}", $controllerName . "update")->middleware("can:" . $controller . ".edit")->name("update");
        Route::get("delete/{id}", $controllerName . "delete")->middleware("can:" . $controller . ".delete")->name("delete");
    });

    /*------ Bank ------*/
    $prefix = "bank";
    $controller = "bank";
    Route::prefix($prefix)->name($controller . ".")->group(function () use($controller){
        $controllerName = ucfirst($controller) . "Controller@";
        Route::get("/", $controllerName . "index")->middleware("can:" . $controller . ".index")->name("index");
        Route::get("create", $controllerName . "create")->middleware("can:" . $controller . ".create")->name("create");
        Route::post("store", $controllerName . "store")->middleware("can:" . $controller . ".create")->name("store");
        Route::get("edit/{id}", $controllerName . "edit")->middleware("can:" . $controller . ".edit")->name("edit");
        Route::post("update/{id}", $controllerName . "update")->middleware("can:" . $controller . ".edit")->name("update");
        Route::get("delete/{id}", $controllerName . "delete")->middleware("can:" . $controller . ".delete")->name("delete");
    });

    /*------ Menu ------*/
    $prefix = "menu";
    $controller = "menu";
    Route::prefix($prefix)->name($controller . ".")->group(function () use($controller){
        $controllerName = ucfirst($controller) . "Controller@";
        Route::get("/", $controllerName . "index")->middleware("can:" . $controller . ".index")->name("index");
    });

    /*------ Blog ------*/
    $prefix = "blog";
    $controller = "blog";
    Route::prefix($prefix)->name($controller . ".")->group(function () use($controller){
        $controllerName = ucfirst($controller) . "Controller@";
        Route::get("/", $controllerName . "index")->middleware("can:" . $controller . ".index")->name("index");
        Route::get("create", $controllerName . "create")->middleware("can:" . $controller . ".create")->name("create");
        Route::post("store", $controllerName . "store")->middleware("can:" . $controller . ".create")->name("store");
        Route::get("edit/{id}", $controllerName . "edit")->middleware("can:" . $controller . ".edit")->name("edit");
        Route::post("update/{id}", $controllerName . "update")->middleware("can:" . $controller . ".edit")->name("update");
        Route::get("delete/{id}", $controllerName . "delete")->middleware("can:" . $controller . ".delete")->name("delete");
    });

    /*------ Blog ------*/
    $prefix = "blog_category";
    $controller = "blog_category";
    Route::prefix($prefix)->name($controller . ".")->group(function () use($controller){
        $controllerName = ucfirst($controller) . "Controller@";
        Route::get("/", $controllerName . "index")->middleware("can:" . $controller . ".index")->name("index");
        Route::get("create", $controllerName . "create")->middleware("can:" . $controller . ".create")->name("create");
        Route::post("store", $controllerName . "store")->middleware("can:" . $controller . ".create")->name("store");
        Route::get("edit/{id}", $controllerName . "edit")->middleware("can:" . $controller . ".edit")->name("edit");
        Route::post("update/{id}", $controllerName . "update")->middleware("can:" . $controller . ".edit")->name("update");
        Route::get("delete/{id}", $controllerName . "delete")->middleware("can:" . $controller . ".delete")->name("delete");
    });

    /*------ Banners ------*/
    $prefix = "banner";
    $controller = "banner";
    Route::prefix($prefix)->name($controller . ".")->group(function () use($controller){
        $controllerName = ucfirst($controller) . "Controller@";
        Route::get("/", $controllerName . "index")->middleware("can:" . $controller . ".index")->name("index");
        Route::get("create", $controllerName . "create")->middleware("can:" . $controller . ".create")->name("create");
        Route::post("store", $controllerName . "store")->middleware("can:" . $controller . ".create")->name("store");
        Route::get("edit/{id}", $controllerName . "edit")->middleware("can:" . $controller . ".edit")->name("edit");
        Route::post("update/{id}", $controllerName . "update")->middleware("can:" . $controller . ".edit")->name("update");
        Route::get("delete/{id}", $controllerName . "delete")->middleware("can:" . $controller . ".delete")->name("delete");
    });

    /*------ Coupon ------*/
    $prefix = "coupon";
    $controller = "coupon";
    Route::prefix($prefix)->name($controller . ".")->group(function () use($controller){
        $controllerName = ucfirst($controller) . "Controller@";
        Route::get("/", $controllerName . "index")->middleware("can:" . $controller . ".index")->name("index");
        Route::get("create", $controllerName . "create")->middleware("can:" . $controller . ".create")->name("create");
        Route::post("store", $controllerName . "store")->middleware("can:" . $controller . ".create")->name("store");
        Route::get("edit/{id}", $controllerName . "edit")->middleware("can:" . $controller . ".edit")->name("edit");
        Route::post("update/{id}", $controllerName . "update")->middleware("can:" . $controller . ".edit")->name("update");
        Route::get("delete/{id}", $controllerName . "delete")->middleware("can:" . $controller . ".delete")->name("delete");
    });

    /*------ Widget ------*/
    $prefix = "widget";
    $controller = "widget";
    Route::prefix($prefix)->name($controller . ".")->group(function () use($controller){
        $controllerName = ucfirst($controller) . "Controller@";
        Route::get("/", $controllerName . "index")->middleware("can:" . $controller . ".index")->name("index");
        Route::get("create", $controllerName . "create")->middleware("can:" . $controller . ".create")->name("create");
        Route::post("store", $controllerName . "store")->middleware("can:" . $controller . ".create")->name("store");
        Route::get("edit/{id}", $controllerName . "edit")->middleware("can:" . $controller . ".edit")->name("edit");
        Route::post("update/{id}", $controllerName . "update")->middleware("can:" . $controller . ".edit")->name("update");
        Route::get("delete/{id}", $controllerName . "delete")->middleware("can:" . $controller . ".delete")->name("delete");
    });

    /*------ Order ------*/
    $prefix = "order";
    $controller = "order";
    Route::prefix($prefix)->name($controller . ".")->group(function () use($controller){
        $controllerName = ucfirst($controller) . "Controller@";
        Route::get("/", $controllerName . "index")->middleware("can:" . $controller . ".index")->name("index");
        Route::get("create", $controllerName . "create")->middleware("can:" . $controller . ".create")->name("create");
        Route::post("store", $controllerName . "store")->middleware("can:" . $controller . ".create")->name("store");
        Route::get("edit/{id}", $controllerName . "edit")->middleware("can:" . $controller . ".edit")->name("edit");
        Route::post("update/{id}", $controllerName . "update")->middleware("can:" . $controller . ".edit")->name("update");
        Route::get("delete/{id}", $controllerName . "delete")->middleware("can:" . $controller . ".delete")->name("delete");
        Route::get("view-order-detail/{id}", $controllerName . "viewOrderDetail")->name("viewOrderDetail");
        Route::post("view-order-detail/{id}/change-status", $controllerName . "changeStatus")->name("changeStatus");
    });

    /*------ FAQ ------*/
    $prefix = "faq";
    $controller = "faq";
    Route::prefix($prefix)->name($controller . ".")->group(function () use($controller){
        $controllerName = ucfirst($controller) . "Controller@";
        Route::get("/", $controllerName . "index")->middleware("can:" . $controller . ".index")->name("index");
        Route::get("create", $controllerName . "create")->middleware("can:" . $controller . ".create")->name("create");
        Route::post("store", $controllerName . "store")->middleware("can:" . $controller . ".create")->name("store");
        Route::get("edit/{id}", $controllerName . "edit")->middleware("can:" . $controller . ".edit")->name("edit");
        Route::post("update/{id}", $controllerName . "update")->middleware("can:" . $controller . ".edit")->name("update");
        Route::get("delete/{id}", $controllerName . "delete")->middleware("can:" . $controller . ".delete")->name("delete");
    });

    /*------ Contact ------*/
    $prefix = "contact";
    $controller = "contact";
    Route::prefix($prefix)->name($controller . ".")->group(function () use($controller){
        $controllerName = ucfirst($controller) . "Controller@";
        Route::get("/", $controllerName . "index")->middleware("can:" . $controller . ".index")->name("index");
        Route::get("create", $controllerName . "create")->middleware("can:" . $controller . ".create")->name("create");
        Route::post("store", $controllerName . "store")->middleware("can:" . $controller . ".create")->name("store");
        Route::get("edit/{id}", $controllerName . "edit")->middleware("can:" . $controller . ".edit")->name("edit");
        Route::post("update/{id}", $controllerName . "update")->middleware("can:" . $controller . ".edit")->name("update");
        Route::get("delete/{id}", $controllerName . "delete")->middleware("can:" . $controller . ".delete")->name("delete");
    });

    /*------ Invoices ------*/
    $prefix = "invoices";
    $controller = "invoices";
    Route::prefix($prefix)->name($controller . ".")->group(function () use($controller){
        $controllerName = ucfirst($controller) . "Controller@";
        Route::get("/", $controllerName . "index")->middleware("can:" . $controller . ".index")->name("index");
        Route::get("create/{type}", $controllerName . "create")->middleware("can:" . $controller . ".create")->name("create");
        Route::post("store", $controllerName . "store")->middleware("can:" . $controller . ".create")->name("store");
        Route::get("edit/{id}", $controllerName . "edit")->middleware("can:" . $controller . ".edit")->name("edit");
        Route::post("update/{id}", $controllerName . "update")->middleware("can:" . $controller . ".edit")->name("update");
        Route::get("delete/{id}", $controllerName . "delete")->middleware("can:" . $controller . ".delete")->name("delete");
        Route::get("invoice-detail/{id}", $controllerName . "invoiceDetail")->name("invoiceDetail");
        Route::get("get-product/{id}", $controllerName . "getProduct")->name("getProduct");
        Route::get("get-product-categories", $controllerName . "getProductCategories")->name("getProductCategories");
    });
});
