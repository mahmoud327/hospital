<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Blog;
use App\Models\Category;
use App\Models\Post;
use App\Models\Service;
use App\Traits\ImageTrait;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BannerController extends Controller
{

    use ImageTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


        $banners = Banner::latest()
            ->paginate(10);

        return view('admin.banners.index', compact('banners'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->uploadImage('uploads/banners/', $request->file('image'));
        $banner = Banner::create($request->all());
        $banner->update(['image' => $request->image->hashName()]);

        return back()->with('status', "add successfully");
    }

    public function update(Request $request, Banner $banner)
    {



        $banner->update($request->except('image'));

        if ($request->file('image')) {
            $this->uploadImage('uploads/banners/', $request->file('image'));
            $banner->update(['image' => $request->image->hashName()]);
        };

        return back()->with('status', "add successfully");
    }

    public function destroy(Banner $banner)
    {
        $banner->delete();
        return back()->with('status', "deleted successfully");
    }
}
