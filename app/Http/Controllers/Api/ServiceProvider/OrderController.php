<?php

namespace App\Http\Controllers\Api\ServiceProvider;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use ArinaSystems\JsonResponse\Facades\JsonResponse;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::query()
            ->whereServiceProviderId(auth()->user()->service_provider_id)
            ->with(['services', 'user'])
            ->latest()
            ->paginate(10);
        return JsonResponse::json('ok', ['data' => OrderResource::collection($orders)]);
    }
}
