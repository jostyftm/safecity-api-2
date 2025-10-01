<?php

namespace App\Services;

use App\Models\ControlEntity;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Pagination\AbstractPaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Validation\ValidationException;

class ControlEntityService
{

    /**
     * @var string $keyCache
     */
    private string $keyCache = 'controlEntity';

    /**
     * Constructor
     */
    public function __construct() {}

    /**
     * List ControlEntity
     * 
     * @param Request $request
     * @return Collection
     */
    public function list(Request $request): Collection | AbstractPaginator
    {
        $entities = ControlEntity::all();

        return $entities;
    }

    /**
     * Get ControlEntity
     * 
     * @param ControlEntity $controlEntity
     * @return ControlEntity
     */
    public function get(ControlEntity $controlEntity): ?ControlEntity
    {
        $controlEntityResponse = Cache::remember("{$this->keyCache}_{$controlEntity->id}", 86400, function () use ($controlEntity) {
            return $controlEntity;
        });

        return $controlEntityResponse;
    }

    /**
     * Save ControlEntity
     * 
     * @param Request $request
     * @param ControlEntity $controlEntity
     * @return ControlEntity
     */
    public function save(Request $request): ControlEntity
    {
        $controlEntity = ControlEntity::create($request->all());

        return $controlEntity;
    }

    /**
     * Update ControlEntity
     * 
     * @param Request $request
     * @param ControlEntity $controlEntity
     * @return ControlEntity
     */
    public function update(Request $request, ControlEntity $controlEntity): ControlEntity
    {
        $controlEntity->update($request->all());

        return $controlEntity;
    }

    /**
     * Delete ControlEntity
     * 
     * @param ControlEntity $controlEntity
     * @return void
     */
    public function delete(ControlEntity $controlEntity): void
    {
        $controlEntity->delete();
    }

    /**
     * Get users associated with a ControlEntity
     * 
     * @param ControlEntity $controlEntity
     * @return Collection|AbstractPaginator
     */
    public function getUsers(ControlEntity $controlEntity): Collection | AbstractPaginator
    {
        return $controlEntity->users;
    }

    /**
     * Attach users to a ControlEntity
     * 
     * @param Request $request
     * @param ControlEntity $controlEntity
     * @return User
     */
    public function storeUser(Request $request, ControlEntity $controlEntity): User
    {
        $user = app(UserService::class)->save($request);

        $controlEntity->users()->attach($user);

        return $user;
    }

    /**
     * Remove user from a ControlEntity
     * 
     * @param ControlEntity $controlEntity
     * @param User $user
     * @return void
     */
    public function removeUser(ControlEntity $controlEntity, User $user): void
    {
        $controlEntity->users()->detach($user);

        app(UserService::class)->delete($user);
    }

    /**
     * Get a specific user associated with a ControlEntity
     * 
     * @param ControlEntity $controlEntity
     * @param User $user
     * @return User
     * @throws ValidationException
     */
    public function getUser(ControlEntity $controlEntity, User $user): User
    {
        $user = $controlEntity->users()->where('user_id', $user->id)->first();

        if (is_null($user)) {
            throw ValidationException::withMessages(
                ['user' => [__('entity.user_not_associated')]]
            );
        }

        return $user;
    }
}
