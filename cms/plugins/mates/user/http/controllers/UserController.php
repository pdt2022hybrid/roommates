<?php

namespace Mates\User\Http\Controllers;

use Backend\Classes\Controller;
use Carbon\Carbon;
use Mates\Room\Models\Room;
use RainLab\User\Facades\Auth;
use RainLab\User\Models\User;
use Mates\User\Http\Resources\UserResource;
use Mates\Login\Models\Token;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function getUser(Request $request) {
        $user = User::where('id', $request->get('tokenUserID'))->first();
        return $user;
    }

    public function getRoomUsers(Request $request, $id) {
        $user = User::where('id', $request->get('tokenUserID'))->first();
        $users = User::where('room_id', $id)->firstOrFail();

        return UserResource::collection($users);
    }
}
