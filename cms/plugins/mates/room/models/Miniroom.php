<?php namespace Mates\Room\Models;

use Model;

/**
 * Miniroom Model
 *
 * @link https://docs.octobercms.com/3.x/extend/system/models.html
 */
class Miniroom extends Model
{
    use \October\Rain\Database\Traits\Validation;

    /**
     * @var string table name
     */
    public $table = 'mates_room_minirooms';

    /**
     * @var array rules for validation
     */
    public $rules = [];

    public $belongsTo = [
        'room' => [
            Room::class,
            'key' => 'room_id',
        ]
    ];
}
