<?php

namespace App\Http\Controllers;

use App\Models\User\Rank;
use App\Models\User\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends BaseController
{
    public function getUserByIdAndChildren($id, $children): User
    {
        return User::where('id',$id)->with($children)->first();;
    }

    public function getAllUsers(): Collection|array
    {
        return User::with(['characters', 'type'])->get();
    }

    public function updateUser(Request $request): JsonResponse
    {
        $updaU = $request->get('user');
        ///dd($updaU);
        try {
            $user = User::with(['characters','userRank', 'userType', 'attributeValues.attribute', 'attributeValues.type', 'attributeValues.value'])->find($updaU['id']);
            foreach ($updaU as $key => $property) {
                if ($key === 'user_type')
                    continue;
                else if ($key === 'attribute_values'){
                    foreach ($user->attributeValues as &$attributeValue) {
                        foreach ($property as &$propertyAttributeValue){
                            if($propertyAttributeValue['id'] == $attributeValue->id){
                                $attributeValue->value->value = $propertyAttributeValue['value']['value'];
                                $attributeValue->value->save();
                            }
                        }
                    }
                }
                else if ($key === 'characters')
                    continue;
                else if ($key === 'user_rank'){
                    //$user->userRank()->save($property);
                    $user['rank']=$property['id'];
                }
                else
                    $user[$key] = $property;
            }
            $user->save();

            $user = User::with(['characters','userRank', 'userType', 'attributeValues.attribute', 'attributeValues.type', 'attributeValues.value'])->find($request['user']['id']);
            foreach ($user->attributeValues as &$attributeValue) {
                if ($attributeValue->type->type === 'integer') {
                    $attributeValue->value->value = (int)$attributeValue->value->value;
                }
            }
            return $this->sendResponse($user, 'User saved.');
        } catch (e) {
            return $this->sendError('User save error', ['error' => 'User save error']);
        }
    }
}
