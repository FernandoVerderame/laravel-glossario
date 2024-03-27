<?php

namespace App\Http\Controllers\Admin;

use App\Models\Link;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class LinkController extends Controller
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
        return view('links.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'src' => 'nullable|string|url',
            //Altri campi da validare?
        ], [
            'src.url' => 'Il campo "src" deve essere un URL valido.',
        ]);

        Link::create($request->all());

        return redirect()->route('links.index')->with('success', 'Link creato con successo!');
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Link $link)
    {
        return view('links.edit', compact('link'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Link $link)
    {
        $request->validate([
            'src' => 'nullable|string|url',
            //Altri campi da validare? x2
        ], [
            'src.url' => 'Il campo "src" deve essere un URL valido.',
        ]);

        $link->update($request->all());

        return redirect()->route('links.index')->with('success', 'Link aggiornato con successo!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Link $link)
    {
        $link->delete();

        return redirect()->route('links.index')->with('success', 'Link eliminato con successo!');
    }
}
