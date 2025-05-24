<?php

namespace App\Http\Controllers\Api;

use App\Exports\SafetyPatrolExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\SafetyPatrolRecap\StoreSafetyPatrolRecapRequest;
use App\Http\Resources\SafetyPatrolRecapResource;
use App\Models\SafetyPatrolRecap;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ApiSafetyPatrolRecapController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return SafetyPatrolRecapResource::collection(SafetyPatrolRecap::with(request('relations') ?? [])->paginate(request('per_page', 10)));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSafetyPatrolRecapRequest $request)
    {
        $data = $request->validated();
        if (!$request->has('issued_date')) $data['issued_date'] = now();

        $safetyPatrolRecap = SafetyPatrolRecap::create($data);

        $safetyPatrolRecap->file_path = 'safety-patrol-recap/' . $safetyPatrolRecap->id . '_' . $safetyPatrolRecap->from_date . '_' . $safetyPatrolRecap->to_date . '.xlsx';
        $safetyPatrolRecap->save();

        Excel::store(new SafetyPatrolExport($safetyPatrolRecap), $safetyPatrolRecap->file_path);

        if ($request->has('download') && $request->get('download')) {
            return response()->download(storage_path('app/' . $safetyPatrolRecap->file_path), 'Safety Patrol ' . $safetyPatrolRecap->from_date . ' - ' . $safetyPatrolRecap->to_date . '.xlsx');
        }
        return SafetyPatrolRecapResource::make($safetyPatrolRecap);
    }

    /**
     * Display the specified resource.
     */
    public function show(SafetyPatrolRecap $safetyPatrolRecap)
    {
        if (request()->has('download') && request('download')) {
            return response()->download(storage_path('app/' . $safetyPatrolRecap->file_path), 'Safety Patrol ' . $safetyPatrolRecap->from_date . ' - ' . $safetyPatrolRecap->to_date . '.xlsx');
        }
        return SafetyPatrolRecapResource::make($safetyPatrolRecap);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
