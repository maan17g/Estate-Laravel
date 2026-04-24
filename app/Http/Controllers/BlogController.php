<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\BlogPost;

class BlogController extends Controller {
    public function index() {
        try {
            $posts = BlogPost::with('category')->where('status', 'published')->latest()->paginate(9);
        } catch (\Exception $e) {
            $posts = collect();
        }
        return view('blog.index', compact('posts'));
    }
    public function show($slug) {
        try {
            $post = BlogPost::with('category')->where('slug', $slug)->orWhere('id', $slug)->firstOrFail();
        } catch (\Exception $e) {
            $post = null;
        }
        return view('blog.show', compact('post'));
    }
}
