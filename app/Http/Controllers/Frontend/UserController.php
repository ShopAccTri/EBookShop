<?php

namespace App\Http\Controllers\Frontend;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index(){
        return view("frontend.users.profile");
    }

    public function updateUserDetails(Request $request){
        $request->validate([
            "username" => ["required","string"],
            "phone" => ["required","digits:10"],
            "pincode" => ["required","digits:6"],
            "address" => ["required","string","max:500"],
        ]);

        $user = User::findOrFail(Auth::user()->id);
        

        $user->update([
            "name" => $request->username,
        ]);

        $user->userDetail()->updateOrCreate(
            [
                "user_id" => $user->id,
            ],
            [
                "phone" => $request->phone,
                "pincode" => $request->pincode,
                "address" => $request->address,
            ]
        );

        return redirect()->back()->with("message","Thông tin cá nhân đã được cập nhật");
    }
}
