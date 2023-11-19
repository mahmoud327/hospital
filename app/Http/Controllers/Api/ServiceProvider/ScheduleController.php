<?php

namespace App\Http\Controllers\Api\ServiceProvider;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\ServiceProvider;
use App\Models\ServiceProviderSchedule;
use ArinaSystems\JsonResponse\Facades\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash as FacadesHash;
use Illuminate\Validation\Rule;

class ScheduleController extends Controller
{

    public function store(Request $request)
    {

        ServiceProviderSchedule::create([
            'from' => $request->from,
            'to' => $request->to,
            "date"=>$request->date,
            'day' => $request->day,
            "service_provider_id" => auth()->user()->service_provider_id
        ]);
        return sendJsonResponse([], 'save  Schedules sucessfully ');
    }
}
