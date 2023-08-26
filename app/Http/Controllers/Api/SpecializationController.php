<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\NewResource;
use App\Http\Resources\PostResource;
use App\Models\Category;
use App\Models\NewPage;
use App\Models\Post;
use App\Models\Specialization;
use App\Services\PostService;
use App\Traits\ImageTrait;
use ArinaSystems\JsonResponse\Facades\JsonResponse;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SpecializationController extends Controller
{



    use ImageTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


        $specializations = Specialization::query()

            ->latest()
            ->get();

         return sendJsonResponse($specializations,'specializations');
    }

}
