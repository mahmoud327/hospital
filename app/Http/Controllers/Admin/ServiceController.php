<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\Service;
use App\Traits\ImageTrait;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ServiceController extends Controller
{

    use ImageTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


        $services = Service::latest()
            ->whereParentId(0)
            ->paginate(10);

        return view('admin.services.index', compact('services'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->uploadImage('uploads/services/', $request->file('image'));
        $ervice = Service::create($request->all());
        $ervice->update(['image' => $request->image->hashName()]);

        return back()->with('status', "add successfully");
    }

    public function update(Request $request, $id)
    {
        $category = Service::find($id);
        $category->update($request->except('image'));
        if ($request->image) {
            $this->uploadImage('uploads/services/', $request->file('image'));
            $category->update(['image' => $request->image->hashName()]);
        }



        return back()->with('status', "edit successfully");
    }

    public function destroy($id)
    {
        $category = Service::find($id)->delete();
        return back()->with('status', "deleted successfully");
    }
}
