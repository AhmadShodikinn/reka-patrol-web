<?php

namespace App\Http\Controllers;

use App\Http\Requests\Document\StoreDocumentRequest;
use App\Http\Requests\Document\UpdateDocumentRequest;
use App\Http\Resources\DocumentResource;
use App\Models\Document;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class DocumentController extends Controller
{
    public function index()
    {
        $data = DocumentResource::collection(Document::with(['user'])->paginate(10));
        
        return Inertia::render('Document/Index', [
            'documentRes' => $data, // Fetch your JSA data here
        ]);
    }

    public function store(StoreDocumentRequest $request)
    {
        $document = Document::create([
            'user_id' => auth()->user()->id,
            'file_name' => $request->file('file')->getClientOriginalName(),
            'file_path' => $request->file('file')->store('documents', 'public'),
        ]);

        return $document;
    }

    public function show(Document $document)
    {
        return Inertia::render('Document/Show', [
            'document' => $document,
        ]);
    }

    public function edit(Document $document)
    {
        return Inertia::render('Document/Edit', [
            'document' => $document,
        ]);
    }

    public function update(UpdateDocumentRequest $request, Document $document)
    {
        if ($request->file('file')) {
            if ($document->file_path) {
                if (Storage::disk('public')->exists($document->file_path)) {
                    Storage::disk('public')->delete($document->file_path);
                }
            }
            $document->update([
                'file_name' => $request->file('file')->getClientOriginalName(),
                'file_path' => $request->file('file')->store('documents'),
            ]);
        } else {
            $document->update([
                'file_name' => $request->file_name,
            ]);
        }

        return $document;
    }

    public function destroy(Document $document)
    {
        // Delete the file from storage
        if ($document->file_path) {
            if (Storage::disk('public')->exists($document->file_path)) {
                Storage::disk('public')->delete($document->file_path);
            }
        }
        return $document->delete();

        // return Redirect::route('documents.index')->with('success', 'Document deleted successfully.');
    }

    public function download(Document $document)
    {
        return response()->download(storage_path('app/' . $document->file_path));
    }
    
}
