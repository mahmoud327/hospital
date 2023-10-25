<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\MedicalTypeResource;
use App\Models\MedicalType;
use App\Models\Post;
use ArinaSystems\JsonResponse\Facades\JsonResponse;

use Illuminate\Http\Request;

class MedicalTypeController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $categories = MedicalType::query()
             ->latest()
            ->get();

            return JsonResponse::json('ok', ['data' => MedicalTypeResource::collection($categories)]);

    }



}
