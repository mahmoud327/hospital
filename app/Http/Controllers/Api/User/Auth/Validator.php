<?php

namespace App\Http\Controllers\Api\User\Auth;

class Validator extends \GLibs\Validation\ApiValidation
{

    public function url()
    {
        return "api/v1/user/auth/";
    }

    public function rules()
    {
        if ($this->is('register')) {
            return $this->register();
        } elseif ($this->is('login')) {
            return $this->login();
        }

        return [];
    }

    private function login()
    {
        return [
            'email' => 'required|string|email',
            'password' => 'required',
        ];
    }

    private function register()
    {
        return [
            'name' => 'required|string|max:20',
            'email' => 'required|email|unique:users',
             'phone'         => 'required|min:11|unique:users',
            'password' => 'required|min:8',

        ];
    }

    private function changePassword()
    {
        return [
            'old_password' => 'required|min:8',
            'new_password' => 'required|min:8',
        ];
    }

    public function verifyPhone()
    {
        return [
            'code' => 'required',
            'phone' => 'required|min:11',
        ];
    }

    public function verifyMail()
    {
        return [
            'code' => 'required',
            'phone' => 'required|min:11',
        ];
    }

    public function resendCode()
    {
        return [
            'email' => 'required|email',
        ];
    }

    public function sendCode()
    {
        return [
            'phone' => 'required|min:11',
        ];
    }

    public function verifyCode()
    {
        return [
            'code' => 'required',
            'email' => 'required|email',
        ];
    }

    public function resetForgotPassword()
    {
        return [
            'email' => 'required|string|email',
//            'password' => 'required|min:8',
//            'phone' => 'required|min:11',
        ];
    }

    public function confirmResetPassword()
    {
        return [
            'code' => 'required',
            'email' => 'required|string|email',
            'password' => 'required|min:6',
        ];
    }

}
