<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Pagination\AbstractPaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

class UserService
{

    /**
     * @var string $keyCache
     */
    private string $keyCache = 'user';

    /**
     * Constructor
     */
    public function __construct() {}

    /**
     * List User
     * 
     * @param Request $request
     * @return Collection
     */
    public function list(Request $request): Collection | AbstractPaginator
    {
        $users = User::with('roles')->get();

        return $users;
    }

    /**
     * Get User
     * 
     * @param User $user
     * @return User
     */
    public function get(User $user): ?User
    {
        $userResponse = Cache::remember("{$this->keyCache}_{$user->id}", 86400, function () use ($user) {
            return $user;
        });

        return $userResponse;
    }

    /**
     * Save User
     * 
     * @param Request $request
     * @return User
     */
    public function save(Request $request): User
    {
        $user = User::create($request->all());
        $user->assignRole($request->roles);

        return $user;
    }

    /**
     * Update User
     * 
     * @param Request $request
     * @return User $user
     */
    public function update(Request $request, User $user): User
    {
        $user->update($request->all());
        $user->syncRoles($request->roles);

        return $user;
    }

    /**
     * Delete User
     * 
     * @param User $user
     * @return void
     */
    public function delete(User $user): void
    {
        $user->delete();
    }
}
