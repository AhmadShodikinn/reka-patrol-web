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
        $isLetter = request()->routeIs('letters.*');
     
        $data = DocumentResource::collection(Document::with(['user'])->whereType($isLetter ? 'permenaker' : 'jsa')->paginate(10));
        
        return Inertia::render($isLetter ? 'Letter/Index' : 'Document/Index', [
            'documentRes' => $data,
        ]);
    }

    public function store(StoreDocumentRequest $request)
    {
        $isLetter = request()->routeIs('letters.*');

        $document = Document::create([
            'user_id' => auth()->user()->id,
            'file_name' => $request->file('file')->getClientOriginalName(),
            'file_path' => $request->file('file')->store($isLetter ? 'documents/letter' : 'documents/jsa' , 'public'),
            'type' => $isLetter ? 'permenaker' : 'jsa',
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
        $isLetter = request()->routeIs('letters.*');

        if ($request->file('file')) {
            if ($document->file_path) {
                if (Storage::disk('public')->exists($document->file_path)) {
                    Storage::disk('public')->delete($document->file_path);
                }
            }
            $document->update([
                'file_name' => $request->file('file')->getClientOriginalName(),
                'file_path' => $request->file('file')->store($isLetter ? 'documents/letter' : 'documents/jsa' , 'public'),
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
