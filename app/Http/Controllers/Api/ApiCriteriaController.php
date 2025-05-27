<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CriteriaResource;
use App\Models\Criteria;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class ApiCriteriaController extends Controller
{
    private function applyFilters(Builder $query, Request $request) {
        // Apply filters if provided
        if (request()->has('criteria_type')) {
            $query = $query->where('criteria_type', request('criteria_type'));
        }
        if (request()->has('location_id')) {
            $query = $query->where('location_id', request('location_id'));
        }
        if ($request->has('search')) {
            $query->orWhere(function ($query) use ($request) {
                $query->orWhere('criteria_type', 'like', '%' . $request->search . '%')
                      ->orWhere('criteria_name', 'like', '%' . $request->search . '%');
            })->orWhereHas('location', function ($query) use ($request) {
                $query->where('location_name', 'like', '%' . $request->search . '%');
            });
        }
        if ($request->has('for_inspection')) {
            $query = $query->whereNotIn('id', function ($query) {
                $query->select('criteria_id')
                    ->from('inspections')
                    ->whereMonth('created_at', now()->month)
                    ->groupBy('criteria_id');
            });
        }

        return $query;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $criterias = Criteria::with(request('relations') ?? []);
        $criterias = $this->applyFilters($criterias, request());
        return CriteriaResource::collection($criterias->paginate(request('per_page', 10)));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
