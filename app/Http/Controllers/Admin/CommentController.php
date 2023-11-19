<?php

namespace App\Http\Controllers\Admin;

use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CommentController extends Controller
{
    public function index(){
        $comments = Comment::all();
        return view("admin.comments.list",compact("comments"));
    }

    public function destroy(int $comment_id){
        $comment = Comment::findOrFail($comment_id);

        $comment->delete();

        return redirect()->back()->with("message","Đã xóa bình luận thành công");
    }
}
