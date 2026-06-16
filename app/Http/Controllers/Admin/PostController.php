<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::query()->with('category')->paginate();
        $basket_cnt = Post::withTrashed()->count();
        return view('admin.post.index', ['posts' => $posts, 'basket_cnt' => $basket_cnt]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::query()->pluck('title', 'id')->all();
        return view('admin.post.create', ['categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'max:255'],
            'meta_desc' => ['nullable', 'max:255'],
            'content' => ['required'],
            'category_id' => ['required', 'exists:categories,id'],
            'thumb' => ['nullable', 'max:255'],
        ]);

        Post::query()->create($validated);
        return redirect()->route('posts.index')->with('success', 'The post has been successfully created');
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
    public function edit(string $id)
    {
        $post = Post::query()->findOrFail($id);

        return view('admin.post.edit', ['post' => $post]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $posts = Post::query()->findOrFail($id);
        $validated = $request->validate([
            'title' => ['required', 'max:255'],
            'meta_desc' => ['nullable', 'max:255'],
            'content' => ['required'],
            'category_id' => ['required', 'exists:categories,id'],
            'thumb' => ['nullable', 'max:255'],
        ]);
        $posts->update($validated);
        return redirect()->route('posts.index')->with('success', 'The post has been successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $posts = Post::query()->findOrFail($id);
        $posts->delete();
        return redirect()->route('posts.index')->with('success', 'The post has been successfully deleted');
    }

    public function basket()
    {
        $posts = Post::withTrashed()->paginate();
        return view('admin.post.basket', ['posts' => $posts]);
    }

    public function basketRestore(string $id)
    {
        $post = Post::withTrashed()->findOrFail($id);
        $post->restore();
        return redirect()->route('posts.index')->with('success', 'The post has been successfully restored');
    }

    public function basketDestroy(string $id)
    {
        $post = Post::withTrashed()->findOrFail($id);
        $post->forceDelete();
        return redirect()->route('admin.posts.basket')->with(
            'success',
            'The post has been successfully deleted at basket'
        );
    }

    public function basketRestoreAll(Request $request)
    {
        $validated = $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'integer|exists:posts,id',
        ]);

        Post::withTrashed()->whereIn('id', $validated['ids'])->restore();

        return redirect()->route('posts.index')->with(
            'success',
            'All posts in the basket have been successfully restored'
        );
    }

    public function basketDestroyAll(Request $request)
    {
        $validated = $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'integer|exists:posts,id',
        ]);

        Post::withTrashed()->whereIn('id', $validated['ids'])->forceDelete();
        return redirect()->route('admin.posts.basket')->with(
            'success',
            'All posts in the basket have been successfully deleted'
        );
    }
}
