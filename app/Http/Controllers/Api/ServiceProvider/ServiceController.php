<?php

namespace App\Http\Controllers\Api\ServiceProvider;

use App\Http\Controllers\Controller;
use App\Http\Resources\ServiceProviderServiceResource;
use App\Http\Resources\UserResource;
use App\Models\ServiceProvider;
use App\Models\ServiceProviderService;
use ArinaSystems\JsonResponse\Facades\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash as FacadesHash;
use Illuminate\Validation\Rule;

class ServiceController extends Controller
{

    public function index(Request $request)
    {
        $services = ServiceProviderService::query()
            ->where('service_provider_id', auth()->user()->service_provider_id)
            ->with('service')
            ->latest()
            ->paginate(10);
        return JsonResponse::json('ok', ['data' => ServiceProviderServiceResource::collection($services)]);
    }
    public function store(Request $request)
    {
        // $this->validate($request, [
        //     'services' => 'required|array',
        //     'price' => 'required|numeric'
        // ]);
        foreach ($request->services as $service) {
            $serviceId = $service['id'];
            $price = $service['price'];
            ServiceProviderService::updateOrCreate(
                [
                    'service_id' => $serviceId,
                    'service_provider_id' => auth()->user()->service_provider_id,
                ],
                ['price' => $price]
            );
        }
        return sendJsonResponse([], 'service provider added service sucessfully');
    }
}
