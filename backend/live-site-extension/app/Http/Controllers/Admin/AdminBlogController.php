<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminBlogController extends Controller
{
    public function index() {
        $blogs = Blog::latest()->get();
        return view('admin.blogs.index', compact('blogs'));
    }

    public function create() {
        return view('admin.blogs.create');
    }

    public function store(Request $request) {
        $data = $request->validate([
            'title' => 'required',
            'category' => 'required',
            'content' => 'required',
            'image' => 'required',
            'read_time' => 'required',
        ]);

        if($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('blogs', 'public');
        }

        $data['is_featured'] = $request->has('is_featured');
        Blog::create($data);

        return redirect()->route('admin.blogs.index')->with('success', 'Blog posted!');
    }

    public function destroy(Blog $blog) {
        Storage::disk('public')->delete($blog->image);
        $blog->delete();
        return back()->with('success', 'Blog deleted!');
    }
}