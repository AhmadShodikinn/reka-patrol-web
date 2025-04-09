<?php

namespace App\Http\Controllers;

use App\Models\SafetyPatrol;
use App\Http\Requests\SafetyPatrol\StoreSafetyPatrolRequest;
use App\Http\Requests\SafetyPatrol\UpdateSafetyPatrolRequest;

class SafetyPatrolController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSafetyPatrolRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(SafetyPatrol $safetyPatrol)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SafetyPatrol $safetyPatrol)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSafetyPatrolRequest $request, SafetyPatrol $safetyPatrol)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SafetyPatrol $safetyPatrol)
    {
        //
    }
}
