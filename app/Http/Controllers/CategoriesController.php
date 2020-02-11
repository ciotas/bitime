<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Link;
use App\Models\Tag;
use App\Models\Topic;
use App\Models\User;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    /**
     * @param Category $category
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Category $category, Request $request, Topic $topic, User $user, Link $link)
    {
        $topics = $topic
            ->withOrder($request->order)
            ->where('category_id', $category->id)
            ->with('user', 'category', 'tags')
            ->paginate(20);

//        $active_users = $user->getActiveUsers();
        $links = $link->getAllCached();
        $tags = Tag::withOrder()->get();
        // 传参变量话题和分类到模板中
        return view('topics.index', compact('topics', 'category', 'tags', 'links'));
    }
}
