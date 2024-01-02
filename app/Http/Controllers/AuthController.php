<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }

    public function login(Request $request)
    {
        try {
            $this->validate($request, [
                'email' => 'required|string|email',
                'password' => 'required',
            ]);

            $credentials = $request->only(['email', 'password']);

            if ($token = auth()->attempt($credentials)) {
                return $this->respondWithToken($token);
            }

            return response()->json(['error' => 'Unauthorized'], 401);
        }
        catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function register(Request $request)
    {
        try {
            $this->validate($request, [
                'name' => 'required|string|unique:users',
                'email' => 'required|string|email|unique:users',
                'password' => 'required|string|confirmed',
            ]);

            $user = User::factory()->create(array_merge(
                $request->only(['name', 'email']),
                ['password' => bcrypt($request->password)]
            ));

            return response()->json(['message' => 'User created successfully', 'user' => $user]);
        }
        catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
    * Log the user out (Invalidate the token).
    *
    * @return \Illuminate\Http\JsonResponse
    */
    public function logout()
    {
        try {
            auth()->logout();
        }
        catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getUser()
    {
        try {
            $user = auth()->user();
            if (!$user) {
                return response()->json(['error' => 'User not found'], 404);
            }
            return response()->json($user);
        }
        catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        try {
            return $this->respondWithToken(auth()->refresh(true, true));
        }
        catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Get the token array structure.
     *
     * @param $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }
}
