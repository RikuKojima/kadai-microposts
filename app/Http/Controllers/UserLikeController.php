<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserLikeController extends Controller
{
    public function store(Request $request,$id) {
        //ログインユーザが指定されたidをお気に入りする
        \Auth::user()->add_like($id);
        //お気に入りしても別に画面は変わらないので
        return redirect()->back();
        
    }
    
    public function destroy($id) {
        \Auth::user()->rm_like($id);
        return redirect()->back();
    }
}
