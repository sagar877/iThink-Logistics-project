<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ApiUserService;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    protected $apiUserService;

    public function __construct(ApiUserService $apiUserService)
    {
        $this->apiUserService = $apiUserService;
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        // Use service to get user
        $user = $this->apiUserService->getApiUserByUsername($request->username);

        if (!$user || Hash::check($request->password, $user->password) === false) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        // Create Sanctum token
        $token = $user->createToken('Personal Access Token')->plainTextToken;

        // Save token in api_users table
        $user->api_token = $token;
        $user->save();

        return response()->json([
            'message' => 'Login successful',
            'token' => $token,
        ]);
    }
}
