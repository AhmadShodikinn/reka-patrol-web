<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\DocumentResource;
use App\Models\Document;
use Illuminate\Http\Request;

class ApiDocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $isLetter = request()->routeIs('letters.*');
        $documents = Document::with(request('relations', []))->whereType($isLetter ? 'permenaker' : 'jsa');
        if (request()->has('search')) {
            $documents = $documents->where('file_name', 'like', '%' . request('search') . '%');
        }
        return DocumentResource::collection($documents->paginate(request('per_page', 10)));
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
    public function show(Document $document)
    {
        if (request()->has('download') && request('download')) {
            return response()->download(public_path('storage/' . $document->file_path));
        }
        return DocumentResource::make($document->load(['user']));
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
