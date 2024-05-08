<?php

namespace App\Models;

use App\Models\Store;
use App\Models\StoreRequest;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class User extends Authenticatable{
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    public function following(): BelongsToMany
{
    return $this->belongsToMany(Store::class, 'store_user', 'user_id', 'store_id');
}

    public function store()
    {
        return $this->hasMany(Store::class);
    }

    public function storeRequests()
    {
        return $this->hasMany(StoreRequest::class);
    }
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function followings(){
        return $this->belongsToMany(User::class,'store_user','store_id','user_id')->withTimestamps();
    }

    public function followers(){
        return $this->belongsToMany(User::class,'store_user','user_id','store_id')->withTimestamps();
    }

    public function follows(Store $store)
{
    // Check if the user is following the provided store
    return $this->following()->where('store_id', $store->id)->exists();
}

    protected $hidden = [
        'password',
    ];
    public function bids(){
   return $this->hasMany(Bid::class);
    }
}
