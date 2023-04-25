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
        //TODO: je ti jasne ze toto vies realne vopchat do jedneho riadku
        //return UserResource::make(Auth::register(post()));
    }
    public function login() {
        $creds = [
            'email' => post('email'),
            'password' => post('password')
        ];
        $user = Auth::authenticate($creds);

        $generatedToken = bin2hex(random_bytes(64));

        //netusim ci funguje
        // VYGENERUJE SA NOVY TOKEN AK UZ EXISTUJE
        while(Token::where('token', $generatedToken)->first()) {
            $generatedToken = bin2hex(random_bytes(64));
        }

        Token::where('user_id', $user->id)->delete();

        $token = new Token();
        $token->token = $generatedToken;
        $token->user_id = $user->id;
        $token->token_created_at = Carbon::now();
        $token->save();

        return response()->json([
            'token' => $generatedToken,
            'token_type' => 'bearer',
            'user' => new UserResource($user)
        ]);
    }
}
