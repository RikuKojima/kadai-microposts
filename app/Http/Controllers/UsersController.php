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
    public function show($id) {

        $user = User::find($id);
        $microposts = $user->microposts()->orderBy('created_at','desc')->paginate(10);
        
        $data = [
            'user' => $user,
            'microposts' => $microposts,
            ];
        
        $data += $this->counts($user);
        
        return view('users.show',$data);
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
        $followers = $user->followers()->paginate(10);
        
        $data = [
            'user' => $user,
            'users' => $followers,
            ];
        $data += $this->counts($user);
        
        return view('users.followers',$data);
    }
    
    //お気に入りしているツイートを表示
    
    public function like($id){
        //このidはユーザののid
        $user = User::find($id);
        $fav_posts = $user->like()->paginate(10);
        
        $data = [
            'user' => $user,
            'fav_posts' => $fav_posts,
            ];
        $data += $this->counts($user);
        return view('users.like', $data);
    }
}
