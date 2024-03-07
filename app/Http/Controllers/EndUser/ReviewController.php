<?php

namespace App\Http\Controllers\EndUser;

use App\Http\Controllers\Controller;
use App\Review;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function storeReview(Request $request, $id){
        $review = new Review();

        //Lấy id user review
        $review -> user_id = Auth::user()->id;

        //Lấy id product
        $review -> product_id = $id;

        //Lấy thông tin review
        $review -> content = $request['review'];
        $review->updated_at = Carbon::now('Asia/Ho_Chi_Minh')->toDateTimeString();

        if($request['rating'] == null){
            $review -> rating = 0;
        }
        else
        {
            $review -> rating  = $request['rating'];
        }

        $review -> save();

        return back();
    }

    public function editReview(Request $request, $id){
        $review = Review::find($id);

        $review->content = $request['review'];
        $review->rating = $request['rating'];
        $review->save();

        return back();
    }

    public function deleteReview($id){
        $review = Review::find($id);
        $review -> delete();

        return response() -> json([
            'code' => 200,
        ],200);
    }
}
