<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;

class OrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */

    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [

            'service_provider_id' => 'required|exists:service_providers,id',
            'service_id' => 'required',
            "note" => 'nullable',
            "appointment" => 'required',
            "price_negotiation" => 'nullable',
            "total" => 'required',

        ];
    }
}
