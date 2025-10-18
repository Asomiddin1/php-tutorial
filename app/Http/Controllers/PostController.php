<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;


class PostController extends Controller
{
    public function index()
    {
        $posts = Post::latest()->get();
        return view('posts.posts' , ['posts' => $posts]);
    }

   public function onePost($id)
{
    // 1. Asosiy postni yuklash va Muallif (user) aloqasini ham yuklash.
    // firstOrFail() usuli 404 xatosini avtomatik chiqaradi.
    $requestedPost = Post::with('user')->findOrFail($id);
    
    // 2. Barcha postlarni emas, faqat 3-5 ta so'nggi postlarni yuklash.
    // Bu 'Barcha Postlar' sidebar'i uchun optimallashtirilgan.
    $recentPosts = Post::with('user')
                        ->where('id', '!=', $id) // Joriy postni ro'yxatdan chiqarish
                        ->latest()
                        ->get();
    
    // 3. Ma'lumotlarni yagona massivda Blade'ga yuborish.
    return view('posts.one-post', [
        'post' => $requestedPost,
        'posts' => $recentPosts, // O'zgartirilgan nom (yaxshiroq tushunish uchun)
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
            'body' => 'required|string',
        ]);

        Post::create([
            'user_id' => Auth()->id(),
            'title'   => $request->input('title'),
            'body'    => $request->input('body'),
        ]);

        return redirect('/posts')->with('success', 'Post created successfully!');
    }
    public function edit($id)
    {
        // 1. Postni yuklash
        $post = Post::findOrFail($id); // findOrFail() 404 xatosini avtomatik chiqaradi

        // 2. Gate yordamida ruxsatni tekshirish
        // 'autorise' o'rniga 'authorize' bo'lishi kerak.
        Gate::authorize('edit', $post); 
        
        // 3. Agar ruxsat berilsa, tahrirlash sahifasini ko'rsatish
        return view('posts.post-edit', ['post' => $post]);

    }
    public function update(Request $request, $id)
    {
       
        $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
        ]);

        $post = Post::find($id);
        if (!$post) {
            abort(404, 'Post not found');
        }

        $post->update([
            'title' => $request->input('title'),
            'body' => $request->input('body'),
        ]);

        return redirect('/post/' . $id)->with('success', 'Post updated successfully!');
    }
    public function delete($id)
    {
        // Delete post logic here
        $post = Post::find($id);
        if (!$post) {
            abort(404, 'Post not found');
        }
        $post->delete();
        return redirect('/posts')->with('success', 'Post deleted successfully!');
        
    }
}
