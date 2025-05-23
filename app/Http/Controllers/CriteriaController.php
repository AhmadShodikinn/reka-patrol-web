<?php

namespace App\Http\Controllers;

use App\Http\Resources\CriteriaResource;
use App\Models\Criteria;
use App\Http\Requests\Criteria\StoreCriteriaRequest;
use App\Http\Requests\Criteria\UpdateCriteriaRequest;
use App\Models\Location;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CriteriaController extends Controller
{
    private function applyFilters(Builder $query, Request $request) {
        // Apply filters if provided
        if ($request->has('search')) {
            $query->orWhere(function ($query) use ($request) {
                $query->orWhere('criteria_type', 'like', '%' . $request->search . '%')
                      ->orWhere('criteria_name', 'like', '%' . $request->search . '%');
            })->orWhereHas('location', function ($query) use ($request) {
                $query->where('location_name', 'like', '%' . $request->search . '%');
            });
        }

        return $query;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Criteria::with(['location']);
        $query = $this->applyFilters($query, $request);

        $datas = CriteriaResource::collection($query->paginate(10)->withQueryString());

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
