<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ForgotPasswordRequest;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\LogoutRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Requests\Auth\ResetPasswordRequest;
use App\Http\Resources\Auth\ForgotPasswordResource;
use App\Http\Resources\Auth\LoginResource;
use App\Http\Resources\Auth\RegisterResource;
use App\Http\Resources\Auth\ResetPasswordResource;
use App\Http\Resources\Auth\UserAuthResource;
use App\Http\Resources\Auth\UserRegistretedResource;
use App\Services\AuthService;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Response;

class AuthController extends Controller
{

    public function __construct(
        private readonly AuthService $authService
    ) {}

    /**
     * Login a user and return a token.
     * 
     * @unauthenticated
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(LoginRequest $request): JsonResource
    {
        //
        $response = $this->authService->login($request);

        return LoginResource::make($response);
    }

    /**
     * Get the authenticated user.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function me(Request $request)
    {
        $user = $this->authService->me($request);

        return UserAuthResource::make($user);
    }

    /**
     * Register a new user.
     * 
     * @unauthenticated
     * @param  \App\Http\Requests\Auth\RegisterRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(RegisterRequest $request): JsonResource
    {
        //
        $response = $this->authService->register($request);

        return UserRegistretedResource::make($response);
    }

    /**
     * Logout the authenticated user.
     * 
     * @param  \App\Http\Requests\Auth\LogoutRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(LogoutRequest $request): Response
    {
        $this->authService->logout($request);

        return response()->noContent();
    }

    /**
     * Forgot password request.
     * 
     * @unauthenticated
     * @param  \App\Http\Requests\Auth\ForgotPasswordRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function forgotPassword(ForgotPasswordRequest $request): JsonResource
    {
        $response = $this->authService->forgotPassword($request);

        return ForgotPasswordResource::make($response);
    }

    /**
     * Reset password.
     * 
     * @unauthenticated
     * @param  \App\Http\Requests\Auth\ResetPasswordRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function resetUpdatePassword(ResetPasswordRequest $request): Response
    {
        $response = $this->authService->resetPassword($request);

        return response()->noContent();
    }
}
