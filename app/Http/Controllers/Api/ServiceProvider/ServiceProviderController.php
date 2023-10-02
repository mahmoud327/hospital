<?php

namespace App\Http\Controllers\Api\ServiceProvider;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\ServiceProvider;
use ArinaSystems\JsonResponse\Facades\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash as FacadesHash;
use Illuminate\Validation\Rule;

class ServiceProviderController extends Controller
{
    public function profileInfo()
    {
        $user = auth()->user();
        return JsonResponse::json('ok', ['data' => UserResource::make($user->load('serviceProvider'))]);
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'image_card' => 'required',
            'image' => 'required',
            'business_card_image' => 'required'
        ]);
        if (!is_null(auth()->user()->service_provider_id)) {
            $service_provider =  auth()->user()->serviceProvider()->update([
                'cv' => $request->cv,
            ]);

            auth()->user()->serviceProvider->clearMediaCollection('business_cards');
            auth()->user()->serviceProvider->clearMediaCollection('service_providers');
            auth()->user()->serviceProvider->clearMediaCollection('cards');
        } else {
            $service_provider = ServiceProvider::create([
                'cv' => $request->cv,
            ]);
            auth()->user()->update(['service_provider_id' => $service_provider->id]);
        }

        auth()->user()->serviceProvider->addMedia($request->business_card_image)
            ->toMediaCollection('business_cards');
        auth()->user()->serviceProvider->addMedia($request->image_card)
            ->toMediaCollection('cards');
        auth()->user()->serviceProvider->addMedia($request->image)
            ->toMediaCollection('service_providers');

        return sendJsonResponse([], 'user updated sucessfully');
    }
}
