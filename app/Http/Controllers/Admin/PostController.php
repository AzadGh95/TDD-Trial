<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View|Response
     */
    public function index()
    {
        $posts = Post::latest()->paginate(15);

        return view('admin.post.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View|Response
     */
    public function create()
    {
        $tags = Tag::latest()->get();

        return view('admin.post.create', compact('tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Application|\Illuminate\Http\RedirectResponse|Response|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        // request data (user_id, title, description, image, tags)

        $post = auth()->user()->posts()->create([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'image' => $request->input('image'),
        ]);

        $post->tags()->attach($request->input('tags'));

        return redirect(route('post.index'))
            ->with('message', 'new post has been created');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return Application|Factory|View|Response
     */
    public function edit(Post $post)
    {
        $tags = Tag::latest()->get();

        return view('admin.post.edit', compact('tags', 'post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @return Application|\Illuminate\Http\RedirectResponse|Response|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, Post $post)
    {
        // request data (title, description, image, tags)

        $post->update([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'image' => $request->input('image'),
        ]);

        $post->tags()->sync($request->input('tags'));

        return redirect(route('post.index'))
            ->with('message', 'the post has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return Response
     */
    public function destroy(Post $post)
    {
        //
    }
}
