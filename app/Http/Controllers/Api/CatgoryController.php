<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\PostResource;
use App\Http\Resources\SubCategoryResource;
use App\Models\Category;
use App\Models\Post;
use App\Models\Service;
use App\Services\PostService;
use App\Traits\ImageTrait;
use ArinaSystems\JsonResponse\Facades\JsonResponse;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CatgoryController extends Controller
{


    use ImageTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $categories = Service::query()
            ->whereParentId(0)
             ->latest()
            ->get();

            return JsonResponse::json('ok', ['data' => CategoryResource::collection($categories)]);

    }
    public function getSubCategories($parent_id=null)
    {

        $categories = Service::query()
             ->when($parent_id,function($q)use($parent_id){

                return $q->whereParentId($parent_id);
             })
             ->where('parent_id','!=',0)
            ->latest()
            ->paginate(10);

            return JsonResponse::json('ok', ['data' => SubCategoryResource::collection($categories)]);

    }


}
