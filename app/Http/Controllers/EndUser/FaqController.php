<?php

namespace App\Http\Controllers\EndUser;

use App\faq;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    protected $pathView = "enduser.pages.FAQ.";
    public function index(){
        $data['wishlist'] = session() -> get("wishList");
        $data['carts'] = session() -> get("cart");
        $data['faq'] = faq::orderBy("id") -> get();
        return view($this -> pathView . "index")->with($data);
    }
}
