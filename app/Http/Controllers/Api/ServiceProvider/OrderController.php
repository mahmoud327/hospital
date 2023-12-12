<?php

namespace App\Http\Controllers\Api\ServiceProvider;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\OrderRequest;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use App\Notifications\PatientCreateOrderNotification;
use ArinaSystems\JsonResponse\Facades\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash as FacadesHash;
use Illuminate\Validation\Rule;

class OrderController extends Controller
{

    public function index()
    {

        $orders = Order::whereServiceProviderId(auth()->user()->service_provider_id)->with(['service', 'user'])
            ->latest()->paginate(10);

        return JsonResponse::json('ok', ['data' => OrderResource::collection($orders)]);
    }
}
