<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Bed extends Model
{
    use HasFactory;

    protected $fillable = [
        'address'
    ];

    protected $hidden = [
    ];

    protected $casts = [
    ];
    public function room(): HasOne
    {
        return $this->HasOne(Room::class,'id','room_id');
    }
}
