<?php

namespace App\Http\Controllers\EndUser;

use App\Contact;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    protected $pathView = "enduser.pages.Contact.";

    public function index(){
        $data['wishlist'] = session() -> get("wishList");
        $data['carts'] =  session() -> get("cart");
        $data['contacts'] = Contact::where("status", "active")->get();
        return view($this -> pathView . "index")->with($data);
    }
}
