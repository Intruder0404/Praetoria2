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
        return User::where('id', $id)->with($children)->first();
    }

    public function getAllUsers(): Collection|array
    {
        return User::with(['characters', 'type'])->get();
    }

    public function updateUser(Request $request): JsonResponse
    {
        $updaU = $request->get('user');
        try {
            $user = User::with(['characters', 'type'])->find($updaU['id']);
            $user->fill($updaU);
            $user->type_id = $updaU['type']['id'];
            $user->save();

            $user = User::with(['characters', 'type'])->find($updaU['id']);
            return $this->sendResponse($user, 'User saved.');
        } catch (e) {
            return $this->sendError('User save error', ['error' => 'User save error']);
        }
    }
}
