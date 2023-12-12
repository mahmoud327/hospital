<?php

namespace App\Http\Controllers\Api\User;

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

        $orders = Order::whereUserId(auth()->id())->with(['service', 'serviceProvider'])
            ->latest()->paginate(10);

        return JsonResponse::json('ok', ['data' => OrderResource::collection($orders)]);
    }
    public function store(OrderRequest $request)
    {
        $user = Auth::user();

        $input = $request->validated();
        $input['user_id'] = $user->id;
        $order = Order::create($input);

        if ($order->serviceProvider->user) {
            $order->serviceProvider->user->notify(new PatientCreateOrderNotification($order, $order->serviceProvider->user));
            $title = $user->name . " patient create order";
            $body = $user->name . " patient create order";
            notifyByFirebase($title, $body, (array)$order->user->serviceProvider->fcm_token, [
                'title' => $title
            ]);
        }


        return sendJsonResponse([], 'order created sucesfully');
    }
}
