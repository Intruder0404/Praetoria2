<?php

namespace App\Http\Controllers;

use App\Models\User\Rank;
use App\Models\User\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

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

    public function updateUser(Request $request): Response|JsonResponse
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
    public function add(Request $request): JsonResponse
    {
        $religion = User::create($request->get('religion'));
        $religion->save();
        return $this->sendResponse($religion, 'religion created');
    }

    public function update(User $user, Request $request): JsonResponse
    {
        $updateData = $request->get('religion');
        $user->fill($updateData);
        $user->type_id = $updateData['type']['id'];
        $user->save();
        return $this->sendResponse($user, 'User updated');
    }

    public function delete(User $user): JsonResponse
    {
        $user->delete();
        return $this->sendResponse($user, 'religion deleted');
    }
}
