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

    protected $hidden = [
        'password',
    ];
}
