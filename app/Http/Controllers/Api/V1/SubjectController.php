<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Subject;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Services\SubjectService;
use App\Http\Resources\Subject\SubjectResource;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Requests\Subject\SubjectStoreRequest;
use App\Http\Requests\Subject\SubjectUpdateRequest;

class SubjectController extends Controller
{
    protected SubjectService $service;

    public function __construct(SubjectService $service)
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
        $subjects = Subject::with('phones')->paginate($this->paginate);

        return SubjectResource::collection($subjects);
    }

    /**
     * Store a newly created resource in storage.
     * @param SubjectStoreRequest $request
     * @return JsonResource
     */
    public function store(SubjectStoreRequest $request): JsonResource
    {
        $subject = $this->service->store($request->validated());

        return SubjectResource::make($subject);
    }

    /**
     * Display the specified resource.
     * @param Subject $subject
     * @return JsonResource
     */
    public function show(Subject $subject): JsonResource
    {
        return SubjectResource::make($subject);
    }

    /**
     * Update the specified resource in storage.
     * @param SubjectUpdateRequest $request
     * @param Subject              $subject
     * @return JsonResource
     */
    public function update(SubjectUpdateRequest $request, Subject $subject): JsonResource
    {
        $subject = $this->service->update($subject, $request->validated());

        return SubjectResource::make($subject);
    }

    /**
     * Remove the specified resource from storage.
     * @param Subject $subject
     * @return JsonResponse
     */
    public function destroy(Subject $subject): JsonResponse
    {
        $subject->delete();

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
