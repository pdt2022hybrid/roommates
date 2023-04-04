<?php

namespace Mates\Task\Http\Controllers;

use Backend\Classes\Controller;
use RainLab\User\Models\User;

class TaskController extends Controller
{
    public function createTask(\Request $request) {
        $user = User::where('id', $request->get('tokenUserID'))->first();
        $postData = [
            'user_assigned_id' => post('user_assigned_id'),
            'user_created_id' => $user->id,
            'miniroom_id' => post('miniroom_id'),
            'status_id' => post('status_id'),
            'task_name' => post('task_name'),
            'task_description' => post('task_description'),
            'deadline' => post('deadline'),
        ];

        $task = new Task();
        $task->user_assigned_id = $postData['user_assigned_id'];
        $task->user_created_id = $postData['user_created_id'];
        $task->miniroom_id = $postData['miniroom_id'];
        $task->status_id = $postData['status_id'];
        $task->task_name = $postData['task_name'];
        $task->task_description = $postData['task_description'];
        $task->deadline = $postData['deadline'];
        $task->save();
    }
}
