<?php

namespace Mates\Login\Http\Controllers;

use Backend\Classes\Controller;
use Mates\Login\Http\resources\UserResourceSignUp;
use RainLab\User\Facades\Auth;
use Mates\User\Http\Resources\UserResource;
use RainLab\User\Models\User;
use Mates\Login\Models\Token;
use Carbon\Carbon;
use System\Models\File;

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

        if (request()->hasFile('avatar'))
        {

            $file = new File();
            $file->fromPost(request()->file("avatar"));
            $file->save();
            $user->avatar = $file;
        }

        $user->avatar = $file;
        $user = Auth::register($creds);
        return $this->login($creds['email'], $creds['password']);
    }
    public function login($email = null, $password = null) {
        $creds = [
            'email' => $email,
            'password' => $password
        ];
        if($email == null || $password == null) {
            $creds = [
                'email' => post('email'),
                'password' => post('password')
            ];
        }

        // todo: prerob


        $user = Auth::authenticate($creds);

        $generatedToken = bin2hex(random_bytes(64));

        while(Token::where('token', $generatedToken)->first()) {
            $generatedToken = bin2hex(random_bytes(64));
        }

        Token::where('user_id', $user->id)->delete();



        $token = new Token();
        $token->token = $generatedToken;
        $token->user_id = $user->id;
        $token->token_created_at = Carbon::now();
        $token->save();

        if($email == null || $password == null) {
            return response()->json([
                'token' => $generatedToken,
                'token_type' => 'bearer',
                'user' => new UserResource($user)
            ]);
        }

        return response()->json([
            'token' => $generatedToken,
            'token_type' => 'bearer',
            'user' => new UserResourceSignUp($user)
        ]);
    }
}
