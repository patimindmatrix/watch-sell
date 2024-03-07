<?php

namespace App\Http\Controllers\EndUser;

use App\Blog;
use App\Comment;
use App\Http\Controllers\Controller;
use Facade\FlareClient\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request, $id){
        $model = new Comment();

        //Get post_id
        $singleBlog = Blog::find($id);
        $post_id = $singleBlog -> id;
        $model -> post_id = $post_id;

        //Get user_id
        if(Auth::check()) {
            $user_id = Auth::user()->id;
            $model -> user_id = $user_id;
        }

        $model -> content = $request['content'];
        $model -> save();

        return back();
    }

    public function replyComment(Request $request){
        $parent_comment = Comment::where("id", "=", $request['parent_id'])->first();
        $user_comment = Auth::user();

        $model = new Comment();
        $model -> post_id = $parent_comment -> post_id;
        $model -> user_id = $user_comment -> id;
        $model -> content = $request['content'];
        $model -> parent_id = $parent_comment -> id;
        $model -> save();

        return back();
    }

    public function editComment(Request $request, $id){
        $comment = Comment::find($id);

        $comment -> content = $request['content'];
        $comment -> save();
        return back();
    }

    public function deleteComment($id){
        $comment = Comment::find($id);

        //Xóa comment với parent_id # 0
        if($comment -> parent_id != 0){
            $comment -> delete();
            return response() -> json([
                'code' => 200,
                'type' => 'notParent',

            ],200);
        }

        //Xoá comment với parent_id = 0 -> Xóa toàn bộ comment có parent_id = id trước
        if($comment -> parent_id == 0){
            $parent_comment = Comment::where("parent_id", "=" , $id)->get();
            if(count($parent_comment) > 0){
                foreach ($parent_comment as $cm){
                    $cm -> delete();
                }
            }

            $comment -> delete();

            return response() -> json([
                'code' => 200,
                'type' => 'parentComment',

            ],200);
        }
    }
}
