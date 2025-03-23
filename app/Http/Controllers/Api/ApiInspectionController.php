<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Inspection\StoreInspectionRequest;
use App\Http\Requests\Inspection\UpdateInspectionRequest;
use App\Http\Resources\InspectionResource;
use App\Models\Inspection;
use App\Services\InspectionService;
use Illuminate\Http\Request;

class ApiInspectionController extends Controller
{
    public function __construct(protected InspectionService $service) {}
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return InspectionResource::collection(Inspection::with(request('relations') ?? [])->paginate(request('per_page', 10)));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreInspectionRequest $request)
    {
        $inspection = $this->service->create($request->validated());

        return InspectionResource::make($inspection->load(request('relations') ?? []));
    }

    /**
     * Display the specified resource.
     */
    public function show(Inspection $inspection)
    {
        return InspectionResource::make($inspection->load(request('relations') ?? []));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateInspectionRequest $request, Inspection $inspection)
    {
        $inspection = $this->service->update($inspection, $request->validated());

        return InspectionResource::make($inspection->load(request('relations') ?? []));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Inspection $inspection)
    {
        $this->service->delete($inspection);

        return response()->noContent();
    }
}
