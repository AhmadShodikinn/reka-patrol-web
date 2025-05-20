<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CriteriaResource;
use App\Models\Criteria;
use Illuminate\Http\Request;

class ApiCriteriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $criterias = Criteria::with(request('relations') ?? []);
        if (request()->has('criteria_type')) {
            $criterias = $criterias->where('criteria_type', request('criteria_type'));
        }
        if (request()->has('search')) {
            $criterias = $criterias->where('criteria_name', 'like', '%' . request('search') . '%');
        }
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
