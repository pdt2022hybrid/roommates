<?php

namespace Mates\User\Http\Controllers;

use Backend\Classes\Controller;
use Carbon\Carbon;
use RainLab\User\Facades\Auth;
use RainLab\User\Models\User;
use Mates\User\Http\Resources\UserResource;
use Mates\Login\Models\Token;
use Illuminate\Http\Request;

//TODO: nechces si clearnut importy?

class UserController extends Controller
{
    public function getUserData(Request $request) {
        $user = User::where('id', $request->get('tokenUserID'))->first(); //TODO: mozes pouzit findOrFail(), alebo firstOrFail()
        return $user;
    }
}
