<?php

namespace App\Http\Controllers\Api\User\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use ArinaSystems\JsonResponse\Facades\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash as FacadesHash;
use Illuminate\Validation\Rule;

class AuthController extends Controller
{
    public function register(RegisterRequest $request)
    {

        $request['password'] = bcrypt($request->password);

        $user = User::create($request->all());
        if ($request->tags) {
            $user->tags()->attach($request->tags);
            $user->load('tags');
        }
        if ($request->service_id) {
            $user->load('service');
        }

        return JsonResponse::json('ok', ['data' => UserResource::make($user)]);
    }

    public function login(LoginRequest $request)
    {

        $credentials = request(['email', 'password']);
        if (!auth()->attempt($credentials)) {

            return sendJsonError('Email or Password not correct', 401);
        }
        $user = request()->user();

        return JsonResponse::json('ok', ['data' => UserResource::make($user)]);
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore(auth()->id()),
            ],
            'phone' => [
                'required',
                Rule::unique('users')->ignore(auth()->id()),
            ],

        ]);
        auth()->user()->update($request->all());

        return sendJsonResponse([], 'user updated sucessfully');
    }



    public function resendCode(Request $request)
    {

        $this->validate($request, [
            'email' => 'required',
        ]);

        $user = User::whereEmail($request->email)->firstorfail();

        $code = rand(1111, 9999);
        $user->update(['pin_code' => $code]);

        return sendJsonResponse([
            'pin_code' => $code,
        ], 'the new code has been sent successfully.');
    }
    public function verifyCode(Request $request)
    {

        $this->validate($request, [
            'email' => 'required',
            'pin_code' => 'required',
        ]);

        $user = User::whereEmail($request->email)->firstorfail();

        if ($user->pin_code == $request->pin_code) {

            $user->update([
                'pin_code' => null,
                'email_verified_at' => now()
            ]);
            return sendJsonResponse([], 'The code has been verified and the account activated successfully');
        }
        return sendJsonError('code invaild');
    }

    public function resetPassword(Request $request)
    {

        $user = User::where('email', $request->email)
            ->firstorfail();

        $user->update(['pin_code' => rand(1111, 9999)]);

        return sendJsonResponse(['pin_code' => $user->pin_code], ' successfully sent code.');
    }

    public function changePassword(Request $request)
    {
        $this->validate($request, [
            'old_password' => 'required'
        ]);

        $user = auth()->user();
        if (FacadesHash::check($request->old_password, $user->password)) {

            $this->validate($request, [
                'new_password' => 'required|min:8'
            ]);



            $user->update([
                'password' => bcrypt($request->new_password),

            ]);

            return sendJsonResponse([], 'successfully updated password.');
        }
        return sendJsonError('data is in-vaild');
    }
}
