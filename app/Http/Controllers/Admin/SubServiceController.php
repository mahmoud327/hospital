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

class SubServiceController extends Controller
{

    use ImageTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($parent_id=null)
    {


        $services = Service::query()
            ->where('parent_id',$parent_id)
            ->latest()

            ->paginate(10);

        return view('admin.services.subServices.index', compact('services','parent_id'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $parent_id)
    {
        $this->uploadImage('uploads/services/', $request->file('image'));
        $request['parent_id'] = $parent_id;
      $ervice=  Service::create($request->all());

      $ervice->update(['image'=>$request->image->hashName()]);
        return back()->with('status', "add successfully");
    }

    public function update(Request $request, Service $category)
    {

        $category->update($request->all());


        return back()->with('status', "add successfully");
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return back()->with('status', "deleted successfully");
    }
}
