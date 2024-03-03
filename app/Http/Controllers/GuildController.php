<?php

namespace App\Http\Controllers;

use App\Models\Guild\Guild;
use App\Models\Guild\GuildAttributeValue;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class GuildController extends BaseController
{
    public function add(Request $request): JsonResponse
    {
        $guild = Guild::create($request->get('guild'));
        $guild->save();
        return $this->sendResponse($guild, 'guild created');
    }

    public function update(Guild $guild, Request $request): JsonResponse
    {
        $updateData = $request->get('guild');
        $guild->fill($updateData);
        $guild->save();
        return $this->sendResponse($guild, 'guild updated');
    }

    public function delete(Guild $guild): JsonResponse
    {
        $guild->delete();
        return $this->sendResponse($guild, 'guild deleted');
    }
}
