<?php

namespace App\Http\Controllers;

use App\Events\TestEvent;
use App\Models\Attribute\Attribute;
use App\Models\Bed;
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
use App\Models\Room;
use stdClass;

class OptionController
{
    public function __construct(
        protected UserController $users,
    ) {
    }
    public function getAllOptions(): array
    {
        $images = glob('logo/*');
        foreach($images as &$image){
            $class = new stdClass();
            $class->url = $image;
            $image = $class;
        }
        return [
            'characters'=>Character::with(['rank','family','religion','family.paterFamilia','guild'])->get(),
            'families'=>Family::with(['paterFamilia'])->get(),
            'guilds'=>Guild::with('kingdom')->get(),
            'kingdoms'=>Kingdom::all(),
            'logos'=>$images,
            'religions'=>Religion::all(),
            'ranks'=>Rank::all(),
            'users'=>User::with(['characters', 'type','characters.rank','characters.family','characters.religion','characters.guild','characters.family.paterFamilia'])->get(),
            'userTypes'=>UserType::all(),
            'product'=>Product::with(['productOptions'])->get(),
            'rooms'=>Room::with(['beds'])->get(),
            'beds'=>Bed::with(['room'])->get(),
        ];
    }
}
