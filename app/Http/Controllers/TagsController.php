<?php

namespace App\Http\Controllers;

use App\Models\Link;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagsController extends Controller
{
    public function show(Tag $tag, Link $link)
    {
        $topics = $tag->topics()->withOrder('recent')
            ->with('user', 'category', 'tags')
            ->paginate(20);
        $links = $link->getAllCached();
        $tags = $tag->withOrder()->get();
        return view('topics.index', compact('topics', 'tags', 'links', 'tag'));
    }
}
