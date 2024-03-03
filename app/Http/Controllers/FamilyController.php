<?php

namespace App\Http\Controllers;

use App\Models\Family\Family;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class FamilyController extends BaseController
{
    public function add(Request $request): JsonResponse
    {
        $family = Family::create($request->get('family'));
        $family->save();
        return $this->sendResponse($family, 'family created');
    }

    public function update(Family $family, Request $request): JsonResponse
    {
        $updateData = $request->get('family');
        $family->name = $updateData['name']??'';
        $family->animal = $updateData['animal']??'';
        $family->description = $updateData['description']??'';
        $family->logo = $updateData['logo'];
        $family->save();
        return $this->sendResponse($family, 'family updated');
    }

    public function delete(Family $family): JsonResponse
    {
        $family->delete();
        return $this->sendResponse($family, 'family deleted');
    }
}
