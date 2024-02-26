<?php

namespace App\Http\Controllers;

use App\Models\Character\Character;
use Illuminate\Http\Request;

class CharacterController extends BaseController
{
    public function getCharacters(){
        return Character::with(['attributeValues.attribute.attribute', 'attributeValues.type', 'attributeValues.value'])->get();
    }
    public function update(Character $character,Request $request){
        $updateData = $request->request->all()['character'];
        $character->rank_id = $updateData['rank']['id'];
        if(isset($updateData['rank']['id'])){
            $character->rank_id = $updateData['rank']['id'];
        }
        $character->religion_id = $updateData['religion']['id'];
        if(isset($updateData['religion']['id'])){
            $character->religion_id = $updateData['religion']['id'];
        }
        if(isset($updateData['family']['id'])){
            $character->family_id = $updateData['family']['id'];
        }
        $character->save();
        return $this->sendResponse($character, 'character.');
    }
}
