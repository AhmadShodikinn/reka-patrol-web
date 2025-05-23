<?php

namespace App\Http\Controllers\Api;

use App\Exports\InspectionExport\InspectionExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\InspectionRecap\StoreInspectionRecapRequest;
use App\Http\Resources\InspectionRecapResource;
use App\Models\InspectionRecap;
use Maatwebsite\Excel\Facades\Excel;

class ApiInspectionRecapController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return InspectionRecapResource::collection(InspectionRecap::with(request('relations') ?? [])->paginate(request('per_page', 10)));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreInspectionRecapRequest $request)
    {
        $data = $request->validated();
        if (!$request->has('issued_date')) $data['issued_date'] = now();

        $safetyPatrolRecap = InspectionRecap::create($data);

        // if ($request->has('download') && $request->get('download')) {
        //     return Excel::download(new SafetyPatrolExport($safetyPatrolRecap), 'safety_patrol_recap.xlsx');
        // }
        return InspectionRecapResource::make($safetyPatrolRecap);
    }

    /**
     * Display the specified resource.
     */
    public function show(InspectionRecap $inspectionRecap)
    {
        if (request()->has('download') && request()->get('download')) {
            return Excel::download(new InspectionExport($inspectionRecap), 'inspection_recap.xlsx');
        }
        return InspectionRecapResource::make($inspectionRecap);
    }
}
