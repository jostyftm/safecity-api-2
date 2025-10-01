<?php

namespace App\Http\Controllers\Api\V1\ControlEntity;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserStoreRequest;
use App\Http\Resources\User\UserResource;
use App\Models\ControlEntity;
use App\Models\User;
use App\Services\ControlEntityService;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Response;

class ControlEntityUserController extends Controller
{
    public function __construct(
        private ControlEntityService $controlEntityService
    ) {}

    /**
     * Display a listing of the resource.
     */
    public function index(ControlEntity $controlEntity): AnonymousResourceCollection
    {
        $users = $controlEntity->users;

        return User::collection($users);
    }

    /**
     * Store a newly created resource in storage.
     * 
     * @param Request $request
     * @param ControlEntity $controlEntity
     * @return JsonResource
     */
    public function store(UserStoreRequest $request, ControlEntity $controlEntity): JsonResource
    {
        $response = $this->controlEntityService->storeUser($request, $controlEntity);

        return UserResource::make($response);
    }

    /**
     * Display the specified resource.
     * 
     * @param ControlEntity $controlEntity
     * @param User $user
     * @return JsonResource
     */
    public function show(ControlEntity $controlEntity, User $user): JsonResource
    {
        $user = $this->controlEntityService->getUser($controlEntity, $user);

        return UserResource::make($user);
    }

    /**
     * Remove the specified resource from storage.
     * 
     * @param ControlEntity $controlEntity
     * @param User $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(ControlEntity $controlEntity, User $user): Response
    {
        $controlEntity->users()->detach($user->id);

        return response()->noContent();
    }
}
