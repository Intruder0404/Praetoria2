<?php

namespace App\Http\Controllers;

use App\Events\TestEvent;
use App\Models\Attribute\Attribute;
use App\Models\Character\Character;
use App\Models\DataType;
use App\Models\Family\Family;
use App\Models\Guild\Guild;
use App\Models\Kingdom\Kingdom;
use App\Models\Product;
use App\Models\Religion\Religion;
use App\Models\User\Rank;
use App\Models\User\User;
use App\Models\User\UserType;
use stdClass;

class ProductController
{
    public function __construct(
        protected UserController $users,
    ) {
    }
    public function getAllProducts(): array
    {
        return [
            'product'=>Product::with(['productOptions'])->get(),
        ];
    }
}
