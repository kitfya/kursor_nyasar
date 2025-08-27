<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BlogController extends Controller
{
    
    public function index()
    {
        $posts = Post::with(['author', 'category'])
            ->latest()
            ->paginate(9);

        return view('blog.index', compact('posts'));
    }

    
    public function show($slug)
    {
        $post = Post::with(['author', 'category', 'comments' => function($query) {
            $query->latest(); 
        }])->where('slug', $slug)->firstOrFail();

        return view('blog.show', compact('post'));
    }

    public function store(Request $request, Post $post)
    {
        $request->validate([
            'content' => 'required|string|max:65535',
            'author_name' => 'required|string|max:255',
            'author_email' => 'nullable|email|max:255',
        ]);

        $data = [
            'post_id' => $post->id,
            'content' => $request->content,
            'author_name' => $request->author_name,
            'author_email' => $request->author_email,
        ];

        if (Auth::check()) {
            $data['user_id'] = Auth::id();
        }

        Comment::create($data);

        return back()->with('success', 'Terima kasih! Komentar Anda telah ditambahkan.');
    }
}