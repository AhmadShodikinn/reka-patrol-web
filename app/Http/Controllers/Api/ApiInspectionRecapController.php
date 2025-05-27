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

        $inspectionRecap = InspectionRecap::create($data);

        $inspectionRecap->file_path = 'inspection-recap/' . $inspectionRecap->id . '_' . $inspectionRecap->from_date . '_' . $inspectionRecap->to_date . '.xlsx';
        $inspectionRecap->save(); 

        Excel::store(new InspectionExport($inspectionRecap), $inspectionRecap->file_path);
        
        if ($request->has('download') && $request->get('download')) {
            return response()->download(storage_path('app/' . $inspectionRecap->file_path), '5R ' . $inspectionRecap->from_date . ' - ' . $inspectionRecap->to_date . '.xlsx');
        }
        return InspectionRecapResource::make($inspectionRecap);
    }

    /**
     * Display the specified resource.
     */
    public function show(InspectionRecap $inspectionRecap)
    {
        if (request()->has('download') && request()->get('download')) {
            return response()->download(storage_path('app/' . $inspectionRecap->file_path), '5R ' . $inspectionRecap->from_date . ' - ' . $inspectionRecap->to_date . '.xlsx');
        }
        return InspectionRecapResource::make($inspectionRecap);
    }
}
