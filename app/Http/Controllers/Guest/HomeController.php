<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use App\Models\Word;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __invoke(Request $request)
    {
        $published_filter = $request->query('published_filter');
        $tag_filter = $request->query('tag_filter');

        $words = Word::public($published_filter)->orderByDesc('updated_at')->orderByDesc('created_at')->tag($tag_filter)->get();
        $tags = Tag::select('id', 'label')->get();

        return view('guest.home', compact('words', 'tags', 'tag_filter', 'published_filter'));
    }
}
