<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use App\Http\Services\UserService;
use App\Http\Controllers\Controller;
use App\Http\Resources\User\UserResource;
use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\UserUpdateRequest;
use Illuminate\Http\Resources\Json\JsonResource;

class UserController extends Controller
{
    protected UserService $service;

    public function __construct(UserService $service)
    {
        parent::__construct();
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     * @return JsonResource
     */
    public function index(): JsonResource
    {
        $users = User::with('subject')->paginate($this->paginate);

        return UserResource::collection($users);
    }

    /**
     * Store a newly created resource in storage.
     * @param StoreUserRequest $request
     * @return JsonResource
     */
    public function store(StoreUserRequest $request): JsonResource
    {
        $user = $this->service->store($request->validated());

        return UserResource::make($user);
    }

    /**
     * Display the specified resource.
     * @param User $user
     * @return JsonResource
     */
    public function show(User $user): JsonResource
    {
        return UserResource::make($user);
    }

    /**
     * Update the specified resource in storage.
     * @param UserUpdateRequest $request
     * @param User              $user
     * @return JsonResource
     */
    public function update(UserUpdateRequest $request, User $user): JsonResource
    {
        $user = $this->service->update($user, $request->validated());

        return UserResource::make($user);
    }

    /**
     * Remove the specified resource from storage.
     * @param User $user
     * @return JsonResponse
     */
    public function destroy(User $user): JsonResponse
    {
        $user->delete();

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
