<?php

namespace Mates\Login\Http\Controllers;

use Backend\Classes\Controller;
use RainLab\User\Facades\Auth;
use Mates\Login\Http\Resources\UserResource;
use RainLab\User\Models\User;
use Mates\Login\Models\Token;
use Carbon\Carbon;

class SignUpController extends Controller
{
    public function signup() {
        $creds = [
            "name" => post("name"),
            "surname" => post("surname"),
            "email" => post("email"),
            "password" => post("password"),
            "password_confirmation" => post("password_confirmation")
        ];
        $user = Auth::register($creds);
        return UserResource::make($user);
    }
    public function login() {
        $creds = [
            'email' => post('email'),
            'password' => post('password')
        ];
        $user = Auth::authenticate($creds);

        $token = new Token();
        $token->token = bin2hex(random_bytes(32));
        $token->user_id = $user->id;
        $token->token_created_at = Carbon::now();
        $token->save();

        return UserResource::make($user);
    }
}
