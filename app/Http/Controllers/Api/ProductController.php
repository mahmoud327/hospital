<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\NewResource;
use App\Http\Resources\PostResource;
use App\Http\Resources\ProductResource;
use App\Http\Resources\UserBuyProductResource;
use App\Models\Category;
use App\Models\NewPage;
use App\Models\Post;
use App\Models\Product;
use App\Models\UserBuyPorduct;
use App\Services\PostService;
use App\Traits\ImageTrait;
use ArinaSystems\JsonResponse\Facades\JsonResponse;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{



    use ImageTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


        $products = Product::query()
           ->when(request()->search,function($q){
            $q->search(request()->search);
           })

           ->when(request()->category_id,function($q){
            $q->where('category_id',request()->category_id);
           })

            ->with(['category'])

            ->latest()
            ->paginate(10);

        return JsonResponse::json('ok', ['data' => ProductResource::collection($products)]);
    }
    public function show($id)
    {

        $product = Product::query()
            ->with(['category'])
            ->findOrfail($id);

        return JsonResponse::json('ok', ['data' => ProductResource::make($product)]);;
    }
    public function buyProudct(Request $request)
    {

        $this->validate($request,[
            'product_id'=>'required|numeric'
        ]);

        $product = UserBuyPorduct::create([
            'user_id'=>auth()->id(),
            'product_id'=>$request->product_id
        ]);

        return sendJsonResponse([],'user buy product sucessfully');
    }

    public function getbuyProudct()
    {



        $products = UserBuyPorduct::

        whereUserId(auth()->id())
        ->with(['user','product'])
        ->paginate(10);


        return JsonResponse::json('ok', ['data' => UserBuyProductResource::collection($products)]);
    }
}
