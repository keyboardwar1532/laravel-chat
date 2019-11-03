<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use JWTAuth;
use Illuminate\Http\Request;
use App\User;
class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api',['except'=>['login','signup']]);
    }

    public function login()
    {
        $credentials = request(['email', 'password']);

        if (! $token = JWTAuth::attempt($credentials)) {
            return response()->json(['status' => 1, 'message' => 'invalid credentials'], 401);
        }

        return $this->respondWithToken($token);
    }

    public function signup(Request $request)
    {
        User::create($request->all());
        return $this->login($request);

    }

    public function me()
    {
        $data = auth()->user()->toArray();
        echo "<pre>";
        print_r($data);
        echo "</pre>";
        // return response()->json(auth()->user());
    }

    public function refresh(){
        return $this->respondWithToken(JWTAuth::parseToken()->refresh());
    }

    public function logout()
    {
        auth()->logout();
        return response()->json(['message' => 'Successfully logged out']);
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'token' => $token,
            'expires' => auth('api')->factory()->getTTL() * 60,
        ]);
    }
}