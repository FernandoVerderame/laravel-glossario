<?php

namespace App\Http\Controllers\Admin;

use App\Models\Word;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Tag;

class WordController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $words = Word::orderByDesc('updated_at')->orderByDesc('created_at')->get();

        return view('admin.words.index', compact('words'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $word = new Word();
        $tags = Tag::select('label', 'id')->get();
        return view('admin.words.create', compact('word', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        dd($request->all());

        $data = $request->validate([
            'term' => 'required|string|max:50|unique:words',
            'definition' => 'required|string',
            'technology' => 'nullable|string|max:50',
            'is_published' => 'nullable|boolean',
            'tags' => 'nullable|exists:tags,id'
        ], [
            'term.required' => 'Termine obbligatorio',
            'term.max' => 'Il Termine può avere massimo :max caratteri',
            'term.unique' => 'Il Termine è già esistente',
            'definition.required' => 'La descrizione è obbligatoria',
            'technology.max' => 'Il campo può avere massimo :max caratteri',
            'tags.exists' => 'Tag selezionatonon valido'
        ]);

        $word = new Word();

        $word->fill($data);

        $word->slug = Str::slug($word->term);
        $word->is_published = Arr::exists($data, 'is_published');

        $word->save();

        if (Arr::exists($data, 'tags')) {
            $word->tags()->attach($data['tags']);
        }

        return to_route('admin.words.show', $word);
    }

    /**
     * Display the specified resource.
     */
    public function show(Word $word)
    {
        return view('admin.words.show', compact('word'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Word $word)
    {
        // $word = Word::findOrFail($word->id);
        $tags = Tag::select('label', 'id')->get();
        $prev_tags = $word->tags->pluck('id')->toArray();
        return view('admin.words.edit', compact('word', 'tags', 'prev_tags'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Word $word)
    {
        $data = $request->validate([
            'term' => ['required', 'string', 'max:50', Rule::unique('words')->ignore($word->id)],
            'definition' => 'required|string',
            'technology' => 'nullable|string|max:50',
            'is_published' => 'nullable',
            'tags' => 'nullable|exists:tags,id'
        ], [
            'term.required' => 'Termine obbligatorio',
            'term.max' => 'Il Termine può avere massimo :max caratteri',
            'term.unique' => 'Il Termine è già esistente',
            'definition.required' => 'La descrizione è obbligatoria',
            'technology.max' => 'Il campo può avere massimo :max caratteri',
            'tags.exists' => 'Tag selezionatonon valido'
        ]);


        $word->slug = Str::slug($word->term);
        $word->is_published = Arr::exists($data, 'is_published');

        $word->update($data);

        if (Arr::exists($data, 'tags')) $word->tags()->sync($data['tags']);
        elseif (!Arr::exists($data, 'tags') && $word->has('tags')) $word->tags()->detach();

        return to_route('admin.words.show', $word)->with('message', "{$word->term} eliminato con successo");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Word $word)
    {
        $word->delete();

        return to_route('admin.words.index')->with('message', "{$word->term} eliminato con successo");
    }

    public function trash()
    {
        $words = Word::onlyTrashed()->get();
        return view('admin.words.trash', compact('words'));
    }

    public function restore(string $id)
    {
        $word = Word::onlyTrashed()->findOrFail($id);
        $word->restore();
        return to_route('admin.words.index');
    }

    public function drop(string $id)
    {
        $word = Word::onlyTrashed()->findOrFail($id);

        $word->forceDelete();

        return to_route('admin.words.index');
    }
}
