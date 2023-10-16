<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use App\Http\Services\ScheduleService;
use App\Exceptions\ScheduleStoreException;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Schedule\ScheduleResource;
use App\Http\Requests\Schedule\ScheduleStoreRequest;
use App\Http\Requests\Schedule\ScheduleUpdateRequest;

class ScheduleController extends Controller
{
    protected ScheduleService $service;

    public function __construct(ScheduleService $service)
    {
        parent::__construct();
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     * @return JsonResource
     */
    public function index()
    {
        $users = User::with('subject')->paginate($this->paginate);

        return ScheduleResource::collection($users);
    }

    /**
     * Store a newly created resource in storage.
     * @param ScheduleStoreRequest $request
     * @param User                 $user
     * @return JsonResponse
     * @throws ScheduleStoreException
     */
    public function store(ScheduleStoreRequest $request, User $user): JsonResponse
    {
        $this->service->store($request->validated(), $user);

        return response()->json('Расписание создано успешно.');
    }

    /**
     * Display the specified resource.
     * @param User $user
     * @return ScheduleResource
     */
    public function show(User $user): ScheduleResource
    {
        return ScheduleResource::make($user);
    }

    /**
     * Update the specified resource in storage.
     * @param ScheduleUpdateRequest $request
     * @param User                  $user
     * @return JsonResponse
     */
    public function update(ScheduleUpdateRequest $request, User $user): JsonResponse
    {
        $this->service->update($request->validated(), $user);

        return response()->json('Расписание обновлено успешно.');
    }

    /** Удаление расписания.
     * @param User $user
     * @return JsonResponse
     */
    public function destroy(User $user): JsonResponse
    {
        $this->service->destroy($user);

        return response()->json('Расписание удалено успешно.');
    }
}
