<?php

namespace App\Http\Controllers;

use App\Http\Resources\CriteriaResource;
use App\Models\Criteria;
use App\Http\Requests\Criteria\StoreCriteriaRequest;
use App\Http\Requests\Criteria\UpdateCriteriaRequest;
use App\Models\Location;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class CriteriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $datas = CriteriaResource::collection(Criteria::with(['location'])->paginate(10));
        return Inertia::render('Criteria/Index', [
            'criteriaRes' => $datas,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Criteria/Create', [
            'locations' => Location::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCriteriaRequest $request)
    {
        logger()->info('Store Criteria', [
            'request' => $request->all(),
        ]);
        Criteria::create($request->validated());

        return Redirect::route('criterias.index')->with('success', 'Kriteria berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Criteria $criteria)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Criteria $criteria)
    {
        return Inertia::render('Criteria/Edit', [
            'criteria' => $criteria->load('location'),
            'locations' => Location::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCriteriaRequest $request, Criteria $criteria)
    {
        $criteria->update($request->validated());

        return Redirect::route('criterias.index')->with('success', 'Kriteria berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Criteria $criteria)
    {
        return $criteria->delete();
    }
}
