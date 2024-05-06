<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'description', 'date_time','store_id',

    ];
    public function bids()
    {
        return $this->hasMany(Bid::class);
    }
    public function store()
    {
        return $this->belongsTo(Store::class);
    }
}

