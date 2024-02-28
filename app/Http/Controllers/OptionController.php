<?php

namespace App\Http\Controllers;

use App\Events\TestEvent;
use App\Models\Attribute\Attribute;
use App\Models\Character\Character;
use App\Models\DataType;
use App\Models\Family\Family;
use App\Models\Guild\Guild;
use App\Models\Kingdom\Kingdom;
use App\Models\Religion\Religion;
use App\Models\User\Rank;
use App\Models\User\User;
use App\Models\User\UserType;

class OptionController
{
    public function __construct(
        protected UserController $users,
    ) {
    }
    public function getAllOptions(): array
    {
        $images = glob('logo/*');
        return [
            'religions'=>Religion::all(),
            'kingdoms'=>Kingdom::all(),
            'guilds'=>Guild::all(),
            'families'=>Family::with(['paterFamilia'])->get(),
            'users'=>User::with(['characters', 'type','characters.family','characters.family.paterFamilia'])->get(),
            'userTypes'=>UserType::all(),
            'attributes'=>Attribute::all(),
            'ranks'=>Rank::all(),
            'characters'=>Character::with(['rank','family','religion','family.paterFamilia'])->get(),
            'data_type'=>DataType::all(),
            'logos'=>$images
        ];
    }
}
