<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    public function microposts() {
        return $this->hasMany(Micropost::class);
    }
    
    public function followings() {
        //Userがフォローしているユーザーたち
        //User::classはUserのメソッドではなくbelongsToManyの書式？
        return $this->belongsToMany(User::class, 'user_follow', 'user_id', 'follow_id')->withTimestamps();
        
    }
    
    public function followers() {
        //Userをフォローしているユーザーたち
        return $this->belongsToMany(User::class, 'user_follow', 'follow_id','user_id')->withTimestamps();
    }
    
    public function is_following($userId) {
        return $this->followings()->where('follow_id', $userId)->exists();
        //follow_idがuser_idのデータが存在するかどうか
    }
    
    public function follow($userId) {
        //すでにフォローしているかどうか
        $exist = $this->is_following($userId);
        
        //自分自身ではないかどうか
        $its_me = $this->id == $userId;
        
        if ($exist | $its_me) {
            return false;
        }else {
            //フォローしていなければフォローする
            $this->followings()->attach($userId);
            return true;
        }
        
    }
    
    public function unfollow($userId) {
        // 既にフォローしているかの確認
    $exist = $this->is_following($userId);
    // 自分自身ではないかの確認
    $its_me = $this->id == $userId;

    if ($exist && !$its_me) {
        // 既にフォローしていればフォローを外す
        $this->followings()->detach($userId);
        return true;
    } else {
        // 未フォローであれば何もしない
        return false;
        }
    }
    
    public function feed_microposts() {
        //userがフォローしているuserのidの取得をする
        $follow_user_id = $this->followings()->pluck('users.id')->toArray();
        $follow_user_ids[] = $this->id;
        return Micropost::whereIn('user_id', $follow_user_ids);
    }
    
    // ユーザーがlikeしている投稿のid
    public function like() {
        return $this->belongsToMany(Micropost::class,'user_like','user_id','like_id')->withTimestamps();
    }
    
    //すでにその投稿をlikeしているかどうかの判定
    public function is_like($id) {
        return $this->like()->where('like_id',$id)->exists();
    }
    
    //お気に入りに追加
    public function add_like($id) {
        //すでにお気に入りしたか
        if($this->is_like($id)) {
            return false;
        }else{
            $this->like()->attach($id);
            return true;
        }
    }
    
    public function rm_like($id) {
        if($this->is_like($id)) {
            $this->like()->detach($id);
            return true;
        }else{
            return false;
        }
    }
}