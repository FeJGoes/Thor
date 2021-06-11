<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\AuthFormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Auth\Authenticatable;

class APIAuthController extends Controller
{
    /**
     * Get a JWT via given credentials.
     *
     * @param App\Http\Requests\AuthFormRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function signIn(AuthFormRequest $request)
    {
        if (!$token = Auth::attempt($request->only('email','senha') + ['ativo' => true])) {
            return response()->json(['message' => __('auth.failed')], 401);
        }

        return $this->respondWithToken($token, Auth::user());
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json(Auth::user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function signOut()
    {
        Auth::logout();

        return response()->json(['message' => __('auth.sign-out')]);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(Auth::refresh(),  Auth::user());
    }

    /**
     * Get the token array structure.
     *
     * @param Illuminate\Contracts\Auth\Authenticatable $usuario
     * @param  string $guard
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token, Authenticatable $usuario)
    {
        $response = $usuario->toArray();
        $response['token'] = $token;
        $response['token_type'] = 'bearer';
        $response['expires_in'] = (int) Auth::guard()->factory()->getTTL();

        return response()->json($response);
    }
}
