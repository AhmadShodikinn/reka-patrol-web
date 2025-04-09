<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\SafetyPatrol\StoreSafetyPatrolRequest;
use App\Http\Requests\SafetyPatrol\UpdateSafetyPatrolRequest;
use App\Http\Resources\SafetyPatrolResource;
use App\Models\SafetyPatrol;
use App\Services\SafetyPatrolService;

class ApiSafetyPatrolController extends Controller
{
    public function __construct(protected SafetyPatrolService $service) {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return SafetyPatrolResource::collection(SafetyPatrol::with(request('relations') ?? [])->paginate(request('per_page', 10)));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSafetyPatrolRequest $request)
    {
        $safetyPatrol = $this->service->create($request->validated());

        return SafetyPatrolResource::make($safetyPatrol->load(request('relations') ?? []));
    }

    /**
     * Display the specified resource.
     */
    public function show(SafetyPatrol $safetyPatrol)
    {
        return SafetyPatrolResource::make($safetyPatrol->load(request('relations') ?? []));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSafetyPatrolRequest $request, SafetyPatrol $safetyPatrol)
    {
        $safetyPatrol = $this->service->update($safetyPatrol, $request->validated());

        return SafetyPatrolResource::make($safetyPatrol->load(request('relations') ?? []));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SafetyPatrol $safetyPatrol)
    {
        $this->service->delete($safetyPatrol);

        return response()->noContent();
    }
}
