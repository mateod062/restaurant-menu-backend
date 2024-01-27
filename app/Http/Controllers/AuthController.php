<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Database\UniqueConstraintViolationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register', 'getUsers']]);
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
                return $this->respondWithToken($token, auth()->user());
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
                'name' => 'required|string',
                'last_name' => 'required|string',
                'email' => 'required|string|email|unique:users',
                'password' => 'required|string|confirmed',
                'is_admin' => 'required|boolean'
            ]);

            $user = User::factory()->create(array_merge(
                $request->only(['name', 'last_name', 'email']),
                ['password' => bcrypt($request->password)],
                ['is_admin' => $request->is_admin ?? false]
            ));

            return response()->json(['message' => 'User created successfully', 'user' => $user]);
        }
        catch (UniqueConstraintViolationException $e) {
            return response()->json(['error' => $e->getMessage()], 403);
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
            $decodedToken = JWTAuth::decode(JWTAuth::getToken());

            // Check if the token has expired
            if ($decodedToken->getClaim('exp') < time()) {
                throw new TokenExpiredException('Token has expired');
            }

            return $this->respondWithToken(auth()->refresh(true, true, true), auth()->user());
        }
        catch (TokenExpiredException $e) {
            return response()->json(['error' => $e->getMessage()], 401);
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
    protected function respondWithToken($token, $user)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
            'name' => $user->name,
            'is_admin' => $user->is_admin,
        ]);
    }
}
