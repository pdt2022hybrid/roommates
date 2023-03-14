<?php

namespace Mates\User\Http\Controllers;

use Backend\Classes\Controller;
use Carbon\Carbon;
use RainLab\User\Facades\Auth;
use RainLab\User\Models\User;
use Mates\User\Http\Resources\UserResource;
use Mates\Login\Models\Token;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function getUserData(Request $request) {
        $token = $request->headers->get('token');;

        $tokenUser = Token::where('token', $token)->first();

        if (!$tokenUser) {
            return response()->json([
                'error' => 'Token not found'
            ], 401);
        }

        if (Carbon::create($tokenUser->token_created_at)->diffInMinutes(Carbon::now()) > 60) {
            return response()->json([
                'error' => 'Token expired'
            ], 401);
        }

        $user = User::where('id', $tokenUser->user_id)->first();
        return $user;
    }
}
