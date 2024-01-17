<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\OrderRequest;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use App\Models\OrderService;
use App\Notifications\PatientCreateOrderNotification;
use ArinaSystems\JsonResponse\Facades\JsonResponse;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{

    public function index()
    {

        $orders = Order::whereUserId(auth()->id())->with(['services', 'serviceProvider'])
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
            $order->serviceProvider->user->notify(new PatientCreateOrderNotification($order, $order->user));
            $title = $user->name . " patient create order";
            $body = $user->name . " patient create order";
            notifyByFirebase($title, $body, (array) optional($order->serviceProvider->user)->fcm_token, [
                'title' => $title,
            ]);
        }

        foreach ($request->services as $service) {
            $serviceId = $service['id'];
            $price = $service['price'];
            $price_negotiation = $service['price_negotiation'];
            OrderService::updateOrCreate(
                [
                    'service_id' => $serviceId,
                    'order_id' => $order->id,
                ],
                ['price' => $price, "price_negotiation" => $price_negotiation]
            );
        }

        return sendJsonResponse([], 'order created sucesfully');
    }
}
