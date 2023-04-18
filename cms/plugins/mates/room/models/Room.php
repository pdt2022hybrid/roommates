<?php namespace Mates\Room\Models;

use Model;
use Mates\Task\Models\Task;
use RainLab\User\Models\User;

/**
 * Room Model
 *
 * @link https://docs.octobercms.com/3.x/extend/system/models.html
 */
class Room extends Model
{
    use \October\Rain\Database\Traits\Validation;

    /**
     * @var string table name
     */
    public $table = 'mates_room_rooms';

    /**
     * @var array rules for validation
     */
    public $rules = [];

    public $hasMany = [
        'miniroom' => [
            Miniroom::class,
        ],
        'tasks' => [
            Task::class,
        ],
    ];

    public $belongsToMany = [
        'users' => [
            User::class,
            'table' => 'mates_user_room',
            'key' => 'room_id',
            'otherKey' => 'user_id',
        ],
    ];

    public $belongsTo = [
        'room_owner' => [
            User::class,
            'key' => 'room_owner_id',
        ],
    ];
}
