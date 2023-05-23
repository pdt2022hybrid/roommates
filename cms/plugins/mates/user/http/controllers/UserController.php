<?php

namespace Mates\User\Http\Controllers;

use Backend\Classes\Controller;
use Illuminate\Support\Facades\Log;
use RainLab\User\Models\User;
use Mates\User\Http\Resources\UserResource;
use Illuminate\Http\Request;
use System\Models\File;

class UserController extends Controller
{
    public function getUser(Request $request) {
        $user = User::find($request->tokenUserID);
        return new UserResource($user);
    }

    public function getRoomUsers($id) {
        $users = User::where('room_id', $id)->get();

        return UserResource::collection($users);
    }

    public function uploadAvatar(Request $request) {
        $user = User::find($request->tokenUserID);

//        if (request()->hasFile('avatar'))
//        {
//            $file = new File();
//            $file->fromPost(request()->file("avatar"));
//            $file->save();
//            $user->avatar()->add($file);
//        }

        if(!request()->hasFile('avatar')) {
            return response()->json([
                'error' => 'Missing image file'
            ]);
        } else {
            $file = new File();
            $file->fromPost(request()->file("avatar"));
            $file->save();
            $user->avatar()->add($file);
        }

        return new UserResource($user);
    }
}
