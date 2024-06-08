<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
  public function register(StoreUserRequest $request): JsonResponse
  {
    $data = $request->validated();
    $data['password'] = bcrypt($data['password']);
    $user = User::create($data);
    $token = $user->createToken('auth_token')->accessToken;

    return response()->json(['message' => 'User created', 'token' => $token], 201);
  }

  public function login(LoginUserRequest $request): JsonResponse
  {
    $data = $request->validated();
    if (!auth()->attempt($data)) {
      return response()->json(['message' => 'Invalid credentials'], 401);
    }

    $user = auth()->user();
    $token = $user->createToken('auth_token')->accessToken;

    return response()->json(['token' => $token], 200);
  }
}
