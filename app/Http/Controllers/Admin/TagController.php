<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\Service;
use App\Models\Tag;
use App\Traits\ImageTrait;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TagController extends Controller
{

    use ImageTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


        $tags=Tag::latest()
        ->get();

        return view('admin.tags.index',compact('tags'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Tag::create($request->all());

        return back()->with('status', "add successfully");
    }

    public function update(Request $request, Tag $tag)
    {

        $tag->update($request->all());


        return back()->with('status', "add successfully");
    }

    public function destroy(Tag $tag)
    {
        $tag->delete();
        return back()->with('status', "deleted successfully");
    }

}
