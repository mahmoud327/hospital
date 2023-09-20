<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\BlogResource;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\PostResource;
use App\Http\Resources\ServiceProviderResource;
use App\Http\Resources\SubCategoryResource;
use App\Models\Blog;
use App\Models\Category;
use App\Models\Post;
use App\Models\Service;
use App\Models\ServiceProvider;
use App\Models\User;
use App\Services\PostService;
use App\Traits\ImageTrait;
use ArinaSystems\JsonResponse\Facades\JsonResponse;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ServiceProviderController extends Controller
{


    use ImageTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($service_id)
    {

        $service_providers = ServiceProvider::whereServiceId($service_id)
           ->latest()
           ->with(['service','tags','user'])
            ->paginate();

        return JsonResponse::json('ok', ['data' => ServiceProviderResource::collection($service_providers)]);
    }
}
