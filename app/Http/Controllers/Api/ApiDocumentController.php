<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Document\StoreDocumentRequest;
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
        $documents = Document::with(request('relations', []))
            ->orderBy('file_name');
        if (request()->has('document_type')) {
            $documents = $documents->whereType(request('document_type'));
        }
        if (request()->has('search')) {
            $documents = $documents->where('file_name', 'like', '%' . request('search') . '%');
        }
        return DocumentResource::collection($documents->paginate(request('per_page', 10)));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDocumentRequest $request)
    {
        $type = $request->get('type', 'memo');

        $document = Document::create([
            'user_id' => auth()->user()->id,
            'file_name' => $request->file('file')->getClientOriginalName(),
            'file_path' => $request->file('file')->store('documents/' . $type , 'public'),
            'type' => $type,
        ]);

        return DocumentResource::make($document->load($request->get('relations', []))); // $document;
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
