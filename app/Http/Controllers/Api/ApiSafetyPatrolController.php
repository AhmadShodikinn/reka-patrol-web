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
        $safetyPatrols = SafetyPatrol::with(request('relations') ?? []);
        if (request()->has('from_date') && request()->has('to_date')) {
            $safetyPatrols = $safetyPatrols->whereBetween(request('sort_date_by') ?? 'updated_at', [request('from_date'), request('to_date')]);
        } else {
            if (request()->has('from_year')) {
                if (request()->has('from_month')) {
                    $safetyPatrols = $safetyPatrols->whereBetween(request('sort_date_by') ?? 'updated_at', [request('from_year') . '-' . request('from_month') . '-01', (request('to_year') ?? request('from_year')) . '-' . (request('to_month') ?? request('from_month')) . '-31']);
                } else {
                    $safetyPatrols = $safetyPatrols->whereBetween(request('sort_date_by') ?? 'updated_at', [request('from_year') . '-01-01', (request('to_year') ?? request('from_year')) . '-12-31']);
                }
            }
        }
        return SafetyPatrolResource::collection($safetyPatrols->paginate(request('per_page', 10)));
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
