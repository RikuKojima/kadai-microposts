<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Micropost;


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
    
    public function followings($id) {
        $user = User::find($id);
        $followings = $user->followings()->paginate(10);

        $data = [
            'user' => $user,
            'users' => $followings,
        ];

        $data += $this->counts($user);

        return view('users.followings', $data);
    }
    
    public function followers($id){
        $user = user::find($id);
        $followings = $user->followers()->paginate(10);
        
        $data = [
            'user' => $user,
            'users' => $followers,
            ];
        $data += $this->counts($user);
        
        return view('users.followers',$data);
    }
    
    
}