<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Comment;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request){
        if(Auth::check()){
            $product = Product::where("slug",$request->product_slug)->where("status","1")->first();

            if($product){
                Comment::create([
                    "product_id" => $product->id,
                    "user_id" => Auth::user()->id,
                    "comment_body" => $request->comment_body,
                ]);
                return redirect()->back()->with("message","Bình luận thành công");
            }else{
                return redirect()->back()->with("message","Không bình luận được");
            }
        }else{
            return redirect("login")->with("message","Đăng nhập để bình luận");
        }
    }

    public function destroy(Request $request){
        if(Auth::check()){

            $comment = Comment::where("id",$request->comment_id)->where("user_id",Auth::user()->id)->first();
            
            if($comment){
                $comment->delete();

                return response()->json([
                    "status" => 200,
                    "message" => "Xóa bình luận thành công",
                ]);
            }else{
                return response()->json([
                    "status" => 500,
                    "message" => "Có lỗi xảy ra",
                ]);
            }
        }else{
            return response()->json([
                "status" => 401,
                "message" => "Đăng nhập để xóa bình luận",
            ]);
        }
    }
}
