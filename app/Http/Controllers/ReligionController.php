<?php

namespace App\Http\Controllers;

use App\Models\Religion\Religion;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ReligionController extends BaseController
{
    public function add(Request $request): JsonResponse
    {
        $religion = Religion::create($request->get('religion'));
        $religion->save();
        return $this->sendResponse($religion, 'religion created');
    }

    public function update(Religion $religion, Request $request): JsonResponse
    {
        $updateData = $request->get('religion');
        $religion->name = $updateData['name']??'';
        $religion->save();
        return $this->sendResponse($religion, 'religion updated');
    }

    public function delete(Religion $religion): JsonResponse
    {
        $religion->delete();
        return $this->sendResponse($religion, 'religion deleted');
    }
}
