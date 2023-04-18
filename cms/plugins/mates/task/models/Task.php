<?php namespace Mates\Task\Models;

use Mates\Status\Models\Status;
use Model;
use Mates\Room\Models\Room;
use Mates\Room\Models\Miniroom;
use RainLab\User\Models\User;

/**
 * Task Model
 *
 * @link https://docs.octobercms.com/3.x/extend/system/models.html
 */
class Task extends Model
{
    use \October\Rain\Database\Traits\Validation;

    /**
     * @var string table name
     */
    public $table = 'mates_task_tasks';

    /**
     * @var array rules for validation
     */
    public $rules = [];

    public $belongsTo = [
        'room' => [
            Room::class,
            'key' => 'room_id',
        ],
        'miniroom' => [
            Miniroom::class,
            'key' => 'miniroom_id',
        ],
        'status' => [
            Status::class,
            'key' => 'status_id',
        ],
        'user' => [
            User::class,
        ],
        'user_assigned' => [
            User::class,
            'key' => 'user_assigned_id',
        ],
    ];
}
