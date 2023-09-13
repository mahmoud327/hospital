<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\BlogResource;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\PostResource;
use App\Http\Resources\SubCategoryResource;
use App\Models\Blog;
use App\Models\Category;
use App\Models\Post;
use App\Models\Service;
use App\Services\PostService;
use App\Traits\ImageTrait;
use ArinaSystems\JsonResponse\Facades\JsonResponse;

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

        $blogs = Blog::query()
            ->latest()

            ->paginate(10);

        return JsonResponse::json('ok', ['data' => BlogResource::collection($blogs)]);
    }

    public function show($id)
    {

        $blog = Blog::query()
            ->findorfail($id);
        $blog->increment('views', 1);

        return JsonResponse::json('ok', ['data' => BlogResource::make($blog)]);
    }
}
