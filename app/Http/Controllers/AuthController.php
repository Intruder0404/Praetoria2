<?php

namespace App\Http\Controllers;

use App\Models\User\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends BaseController
{
    public function __construct(
        protected UserController $users,
    )
    {
    }

    public function register(Request $request): JsonResponse
    {
        try {
            //Validated
            $validateUser = Validator::make($request->all(),
                [
                    'first_name' => 'required',
                    'last_name' => 'required',
                    'username' => 'required',
                    'email' => 'required|email|unique:users,email',
                    'password' => 'required'
                ]);

            if ($validateUser->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validateUser->errors()
                ], 401);
            }

            User::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'username' => $request->username,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ], 201);

            return response()->json([
                'status' => true,
                'message' => 'User Registered Successfully'
            ], 200);

        } catch (\Throwable $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function login(Request $request): JsonResponse
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'isActive'=> 1])) {
            $user = Auth::user();
            return response()->json([
                'token' =>  $user->createToken('MyApp')->plainTextToken,
                'user'=>$this->users->getUserByIdAndChildren($user->id, ['characters', 'type']),
                'message' => 'User Created Successfully',
            ], 200);
        } else {
            return $this->sendError('Unauthorised.', ['error' => 'Unauthorised']);
        }
    }

    public function logout(Request $request): JsonResponse
    {
        $request->user()->currentAccessToken()->delete();
        $success['message'] = 'User Logged Out';
        return $this->sendResponse($success, 'User Logged Out');
    }

    public function azureLogin(): JsonResponse
    {
        $user = Socialite::driver('azure')->user();

        if (Auth::attempt(['email' => $user->email])) {
            $user = Auth::user();
            $success['token'] = $user->createToken('MyApp')->plainTextToken;
            $success['user'] = $this->users->getUserByIdAndChildren(Auth::id(), ['characters', 'userRank', 'userType', 'attributeValues.attribute', 'attributeValues.type', 'attributeValues.value']);;

            return $this->sendResponse($success, 'User login successfully.');
        } else {
            return $this->sendError('Unauthorised.', ['error' => 'Unauthorised']);
        }
    }

    public function azureRedirect(): RedirectResponse
    {
        return Socialite::driver('azure')->redirect();
    }
}
