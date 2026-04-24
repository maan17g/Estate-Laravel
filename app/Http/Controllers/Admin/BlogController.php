<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\BlogPost;

class BlogController extends Controller {
    public function index() {
        $data = BlogPost::with(['category'])->latest()->paginate(15);
        return view("dashboards.admin.blog.index", compact('data'));
    }
}
