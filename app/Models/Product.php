<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'price',
        'description',
    ];

    protected $hidden = [
    ];

    protected $casts = [
    ];
    public function productOptions(): BelongsToMany
    {
        return $this->belongsToMany(ProductOption::class,'product_product_options');
    }
}
