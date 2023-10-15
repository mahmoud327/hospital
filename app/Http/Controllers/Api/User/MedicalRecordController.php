<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\MedicalRecord;
use ArinaSystems\JsonResponse\Facades\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash as FacadesHash;
use Illuminate\Validation\Rule;

class MedicalRecordController extends Controller
{
    public function store(Request $request)
    {
        $medical_record = MedicalRecord::create([
            'user_id' => auth()->id(),
            'name' => $request->name
        ]);
        $medical_record->addMedia($request->image)
            ->toMediaCollection('medical_records');

        return sendJsonResponse([], ' update medical recorded sucessfully');
    }
}
