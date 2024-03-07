<?php

namespace App\Http\Controllers\EndUser;

use App\Blog;
use App\BlogCategory;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BlogController extends Controller
{
    protected $pathView = "enduser.pages.Blog.";

    public function index(){
        $data['wishlist'] = session() -> get("wishList");
        $data['carts'] =  session() -> get("cart");
        $data['blogs'] = Blog::where("status","active")->orderBy("id")->paginate(6);
        $data['blogCategory'] = BlogCategory::where('status','active')->get();
        $data['recentBlog'] = Blog::latest()->limit(4)->get();
        return view($this -> pathView."index")->with($data);
    }

    public function blogDetail($slug){
        $data['wishlist'] = session() -> get("wishList");
        $data['carts'] =  session() -> get("cart");
        $data['blogCategory'] = BlogCategory::where('status','active')->get();
        $data['blogContent'] = Blog::where("slug", $slug)->first();
        //Lấy category của blog
        $data['category'] = $data['blogContent'] -> category;
        //Lấy related category
        $data['relatedBlog'] = $data['category'] -> blogs;
        //Lấy recent blog
        $data['recentBlog'] = Blog::latest()->limit(4)->get();

        //Lấy comment theo post_id
        $data['comments'] = $data['blogContent']->comments()->get();
        //dd($data['comments']);
        $data['commentsAll'] = $data['blogContent'] -> comments() -> latest() -> get();
        return view($this -> pathView."blogDetail")->with($data);
    }

    public function blogByCategory($slug){
        $data['wishlist'] = session() -> get("wishList");
        $data['carts'] =  session() -> get("cart");
        $data['blogCategory'] = BlogCategory::where('status','active')->get();
        $data['category'] = BlogCategory::where("slug", $slug)->first();
        $data['blogs'] = $data['category'] -> blogs() -> paginate(6);
        $data['recentBlog'] = Blog::latest()->limit(4)->get();
        return view($this -> pathView."index")->with($data);
    }
}
