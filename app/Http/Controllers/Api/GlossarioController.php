<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Word;
use Illuminate\Http\Request;

class GlossarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = $request->input('term'); // Ottengo il termine di ricerca dalla query string

        $words = Word::whereIsPublished(true)
            ->when($query, function ($queryBuilder) use ($query) {
                // Applico la ricerca dei termini utilizzando le scope definite nel modello
                return $queryBuilder->tag($query)->orWhere('term', 'like', "%$query%");
            })
            ->latest()
            ->get();

        return response()->json($words);
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
        $word = Word::whereIsPublished(true)->find($id);
        if (!$word)
            return response(null, 404);
        return response()->json($word);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Word $word)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Word $word)
    {
        //
    }
}
