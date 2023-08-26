<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Category;
use App\Models\Post;
use App\Models\Service;
use App\Traits\ImageTrait;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{

    use ImageTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


        $blogs = Blog::latest()
            ->paginate(10);

        return view('admin.blogs.index', compact('blogs'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->uploadImage('uploads/blogs/', $request->file('image'));
        $blog = Blog::create($request->all());
        $blog->update(['image' => $request->image->hashName()]);

        return back()->with('status', "add successfully");
    }

    public function update(Request $request, Blog $blog)
    {


        $blog->update($request->except('image'));

        if ($request->file('image')) {
            $this->uploadImage('uploads/blogs/', $request->file('image'));
            $blog->update(['image' => $request->image->hashName()]);
        };

        return back()->with('status', "add successfully");
    }

    public function destroy(Blog $blog)
    {
        $blog->delete();
        return back()->with('status', "deleted successfully");
    }
}
