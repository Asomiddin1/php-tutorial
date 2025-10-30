<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::latest()->get();
        return view('posts.posts', ['posts' => $posts]);
    }

    public function onePost($id)
    {
        $requestedPost = Post::with('user')->findOrFail($id);
        $recentPosts = Post::with('user')
                            ->where('id', '!=', $id)
                            ->latest()
                            ->get();

        return view('posts.one-post', [
            'post' => $requestedPost,
            'posts' => $recentPosts,
        ]);
    }

    public function create()
    {
        return view('posts.post-create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'body'  => 'required|string',
        ]);

        $post = Post::create([
            'user_id' => Auth()->id(),
            'title'   => $request->input('title'),
            'body'    => $request->input('body'),
        ]);

        Mail::to(Auth()->user()->email)->queue(new \App\Mail\PostAdded($post));

        return redirect('/posts')->with('success', 'Post created successfully!');
    }

    public function edit($id)
    {
        $post = Post::findOrFail($id);
        Gate::authorize('edit', $post);
        return view('posts.post-edit', ['post' => $post]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'body'  => 'required|string',
        ]);

        $post = Post::findOrFail($id);
        Gate::authorize('edit', $post);

        $post->update([
            'title' => $request->input('title'),
            'body'  => $request->input('body'),
        ]);

        Mail::to(Auth()->user()->email)->queue(new \App\Mail\PostEdited($post));

        return redirect('/post/' . $id)->with('success', 'Post updated successfully!');
    }

    public function delete($id)
    {
        $post = Post::findOrFail($id);
        Gate::authorize('delete', $post);

        $post->delete();

        Mail::to(Auth()->user()->email)->queue(new \App\Mail\PostDeleted($post));

        return redirect('/posts')->with('success', 'Post deleted successfully!');
    }
}
