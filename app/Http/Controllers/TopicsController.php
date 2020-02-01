<?php

namespace App\Http\Controllers;

use App\Handlers\ImageUploadHandler;
use App\Models\Category;
use App\Models\Link;
use App\Models\Tag;
use App\Models\Topic;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\TopicRequest;
use Illuminate\Support\Facades\Auth;

class TopicsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show', 'search']]);
    }

	public function index(Request $request, Topic $topic, User $user, Link $link)
	{
        $topics = $topic->withOrder($request->order)
            ->with('user', 'category', 'tags') // 预加载防止 N+1 问题
             ->paginate(20);
        $active_users = $user->getActiveUsers();
        $links = $link->getAllCached();
		return view('topics.index', compact('topics', 'active_users', 'links'));
	}

    public function search(Request $request, Topic $topic, User $user, Link $link)
    {
        $words = trim($request->q);
        if ($words) {
            $topics = $topic->search($words)->paginate(20);
            $active_users = $user->getActiveUsers();
            $links = $link->getAllCached();
            return view('topics.search', compact('topics', 'active_users', 'links'))->with('q', $words);
        } else {
            return back();
        }
	}

    public function show(Request $request, Topic $topic)
    {
        if (! empty($topic->slug) && $topic->slug != $request->slug) {
            return redirect($topic->link(), 301);
        }
        return view('topics.show', compact('topic'));
    }

	public function create(Topic $topic)
	{
        $categories = Category::all();
        $tags = Tag::all();
        $choose_tags = [];
		return view('topics.create_and_edit', compact('topic','categories', 'tags', 'choose_tags'));
	}

	public function store(TopicRequest $request, Topic $topic, Tag $tag)
	{
	    $tilte = $request->title;
	    $category_id = $request->category_id;
	    $top = $request->top;
	    $body = $request->body;
	    $tags = $request->tags;

	    $topic->fill([
	        'title' => $tilte,
            'category_id' => $category_id,
            'top' => $top,
            'body' => $body
        ]); //fill 方法会将传参的键值数组填充到模型的属性中
	    $topic->user_id = Auth::id();
	    $topic->save();

        $topic->tags()->attach($tags);
        return redirect()->to($topic->link())->with('success', '创建成功！！');

    }

	public function edit(Topic $topic)
	{
        $this->authorize('update', $topic);
        $categories = Category::all();
        $tags = Tag::all();

        $choose_tags = $topic->tags()->get()->pluck('id')->toArray();
		return view('topics.create_and_edit', compact('topic', 'categories', 'tags', 'choose_tags'));
	}

	public function update(TopicRequest $request, Topic $topic, Tag $tag)
	{
		$this->authorize('update', $topic);
        $tilte = $request->title;
        $category_id = $request->category_id;
        $top = $request->top;
        $body = $request->body;
//        dd($body);
        $tags = $request->tags;

		$topic->update([
            'title' => $tilte,
            'category_id' => $category_id,
            'top' => $top,
            'body' => $body
        ]);
        $topic->tags()->sync($tags);

		return redirect()->to($topic->link())->with('message', '更新成功～');
	}

	public function destroy(Topic $topic, Tag $tag)
	{
		$this->authorize('destroy', $topic);
		$topic->delete();
		$topic->tags()->detach();
		return redirect()->route('topics.index')->with('message', '删除成功！');
	}

    /**
     * @param Request $request
     * @param ImageUploadHandler $uploader
     * @return array
     */
    public function uploadImage(Request $request, ImageUploadHandler $uploader)
    {
        // 初始化返回数据，默认是失败的
        $data = [
            'success'   => false,
            'msg'       => '上传失败!',
            'file_path' => ''
        ];
        // 判断是否有上传文件，并赋值给 $file
        if ($file = $request->upload_file) {
            // 保存图片到本地
            $result = $uploader->save($file, 'topics', \Auth::id(), 1024);
            // 图片保存成功的话
            if ($result) {
                $data['file_path'] = $result['path'];
                $data['msg']       = "上传成功!";
                $data['success']   = true;
            }
        }
        return $data;
	}
}
