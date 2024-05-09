<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Store extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'description', 'user_id','active'];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function followers(): BelongsToMany
{
    return $this->belongsToMany(User::class, 'store_user', 'store_id', 'user_id');
}
    

public function reviews()
    {
        return $this->hasMany(Review::class);
    }
    

}
