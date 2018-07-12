<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UsersController extends Controller
{
    public function index() {
        $users = User::paginate(10);
        
        return view('users.index', [
                'users' => $users,
            ]);
    }
    
    //id引数を渡して、表示すべきユーザを特定する->user.showへ飛ばす
    public function index() {
        $user = user::find($id);
        
        return view('users.show', [
            'user' => $user,
        ]);
    }
}
