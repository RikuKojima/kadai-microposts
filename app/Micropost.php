<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Micropost extends Model
{
    protected $fillable = ['content', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    //お気に入りにされているかどうか
    public function be_liked() {
        return $this->belongsToMany(User::class,'user_like','like_id','user_id')->withTimestamps();
    }
}