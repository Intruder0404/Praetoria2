<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Room extends Model
{
    use HasFactory;
    protected $fillable = [
        'address'
    ];

    protected $hidden = [
    ];

    protected $casts = [
    ];
    public function beds(): HasMany
    {
        return $this->hasMany(Bed::class,'room_id','id');
    }
}
