<?php

namespace App\Http\Controllers\Api\V1\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserListRequest;
use App\Http\Requests\User\UserStoreRequest;
use App\Http\Requests\User\UserUpdateRequest;
use App\Http\Resources\User\UserResource;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Response;

class UserController extends Controller
{
    public function __construct(
        private UserService $userService
    ) {}

    /**
     * Display a listing of the resource.
     * 
     * @param UserListRequest $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection<UserResource>
     */
    public function index(UserListRequest $request): AnonymousResourceCollection
    {
        $users = $this->userService->list($request);

        return UserResource::collection($users);
    }

    /**
     * Store a newly created resource in storage.
     * 
     * @param UserStoreRequest $request
     * @return JsonResource
     */
    public function store(UserStoreRequest $request): JsonResource
    {
        $user = $this->userService->save($request);

        return UserResource::make($user);
    }

    /**
     * Display the specified resource.
     * 
     * @param User $user
     * @return JsonResource
     */
    public function show(User $user): JsonResource
    {
        $user = $this->userService->get($user);

        return UserResource::make($user);
    }

    /**
     * Update the specified resource in storage.
     * 
     * @param UserUpdateRequest $request
     * @param User $user
     * @return JsonResource
     */
    public function update(UserUpdateRequest $request, User $user): JsonResource
    {
        $user = $this->userService->update($request, $user);

        return UserResource::make($user);
    }

    /**
     * Remove the specified resource from storage.
     * 
     * @param User $user
     * @return Response
     */
    public function destroy(User $user): Response
    {
        $user->delete();

        return response()->noContent();
    }
}
