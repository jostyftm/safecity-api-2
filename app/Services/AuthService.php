<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Pagination\AbstractPaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Str;

class AuthService
{

    /**
     * @var string $keyCache
     */
    private string $keyCache = 'model';

    /**
     * Constructor
     */
    public function __construct() {}

    /**
     * Handle an authentication attempt.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return array<string, string>
     */
    public function login(Request $request)
    {
        $user = User::where('email', $request->email)->first();

        if (! $user || !Hash::check($request->password, $user->password)) {
            throw \Illuminate\Validation\ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        if (!Auth::attempt($request->only('email', 'password'))) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        $user = Auth::user();

        return [
            'access_token' => $user->createToken(
                name: 'auth_token',
                abilities: $user->getAllPermissions()->pluck('name')->toArray(),
                expiresAt: now()->addDay()
            )->plainTextToken,
            'token_type' => 'bearer'
        ];
    }

    /**
     * 
     */
    public function me(Request $request)
    {
        return $request->user();
    }

    /**
     * Handle a registration request.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \App\Models\User
     */
    public function register(Request $request): User
    {
        $user = User::create($request->all());
        $user->assignRole('user');

        return $user;
    }

    /**
     * Handle a logout request.
     * 
     * @param  \Illuminate\Http\Request  $request
     */
    public function logout(Request $request): void
    {
        /** @var \Laravel\Sanctum\PersonalAccessToken $token */
        $token = request()->user()->currentAccessToken();
        $token->delete();
    }

    /**
     * Handle a password reset request.
     * 
     * @param  \Illuminate\Http\Request  $request
     * 
     */
    public function forgotPassword(Request $request): array
    {
        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
            ? ['status' => __($status)]
            : ['email' => __($status)];
    }

    /**
     * 
     */
    public function resetPassword(Request $request): void
    {
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );

        if ($status != Password::PASSWORD_RESET) {
            throw ValidationException::withMessages([
                'email' => [__($status)],
            ]);
        }
    }
}
