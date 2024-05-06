<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable{
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    public function store()
    {
        return $this->hasMany(Store::class);
    }

    public function storeRequests()
    {
        return $this->hasMany(StoreRequest::class);
    }

    public function followings(){
        return $this->belongsToMany(User::class,'store_user','store_id','user_id')->withTimestamps();
    }

    public function followers(){
        return $this->belongsToMany(User::class,'store_user','user_id','store_id')->withTimestamps();
    }

    public function follows(User $user){
        return $this->followings()->where('user_id', $user->id)->exists();
    }

    protected $hidden = [
        'password',
    ];
}
