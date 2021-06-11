<?php

namespace App\Exceptions;

use Exception;
use Throwable;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Auth\Access\AuthorizationException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'senha',
        'senha_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            if (request()->expectsJson() || request()->is('api/*')) {
                if ($e instanceof NotFoundHttpException) {
                    return response()->json(['message' => __('http.404')], 404);
                }

                if ($e instanceof AuthorizationException ) {
                    return response()->json(['message' => __('http.403')], 403);
                }

                if ($e instanceof AuthenticationException
                    || $e instanceof UnauthorizedHttpException
                ) {
                    try {
                        if (!JWTAuth::parseToken()->authenticate()) {
                            return response()->json(['message' => __('jwt.user-not-found')], 401);
                        }
                    } catch (TokenExpiredException $e) {
                        return response()->json(['message' => __('jwt.expired')], 401);
                    } catch (TokenInvalidException  $e) {
                        return response()->json(['message' => __('jwt.invalid')], 401);
                    } catch (JWTException   $e) {
                        return response()->json(['message' => __('jwt.absent')], 401);
                    } catch (Exception $e) {
                        return response()->json(['message' => __('http.401')], 401);
                    }
                }
            }
        });
    }

}
