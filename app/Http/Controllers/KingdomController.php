<?php

namespace App\Http\Controllers;

use App\Models\Kingdom\Kingdom;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class KingdomController extends BaseController
{
    public function getAllKingdoms(){
        return Kingdom::with(['attributeValues.attribute.attribute','attributeValues.type','attributeValues.value'])->get();
    }
    public function add(Request $request): JsonResponse
    {
        $kingdom = Kingdom::create($request->get('kingdom'));
        $kingdom->save();
        return $this->sendResponse($kingdom, 'Kingdom created');
    }

    public function update(Kingdom $kingdom, Request $request): JsonResponse
    {
        $updateData = $request->get('kingdom');
        $kingdom->name = $updateData['name']??'';
        $kingdom->save();
        return $this->sendResponse($kingdom, 'guild updated');
    }

    public function delete(Kingdom $kingdom): JsonResponse
    {
        $kingdom->delete();
        return $this->sendResponse($kingdom, 'guild deleted');
    }
}
