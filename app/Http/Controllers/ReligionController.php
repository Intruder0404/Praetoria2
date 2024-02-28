<?php

namespace App\Http\Controllers;

use App\Models\Religion\Religion;
use Illuminate\Http\Client\Request;
use Illuminate\Http\Response;

class ReligionController extends BaseController
{
    public function getAllReligions(){
        return Religion::with(['attributeValues.attribute.attribute','attributeValues.type','attributeValues.value'])->get();
    }
    public function add(Request $request): Response
    {
        $religion = Religion::create($request->get('religion'));
        $religion->save();
        return $this->sendResponse($religion, 'religion created');
    }

    public function update(Religion $religion, Request $request): Response
    {
        $updateData = $request->get('religion');
        $religion->name = $updateData['name']??'';
        $religion->save();
        return $this->sendResponse($religion, 'religion updated');
    }

    public function delete(Religion $religion): Response
    {
        $religion->delete();
        return $this->sendResponse($religion, 'religion deleted');
    }
}
