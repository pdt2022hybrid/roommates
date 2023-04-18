<?php namespace Mates\Code\Models;

use Model;
use Mates\Room\Models\Room;

/**
 * Code Model
 *
 * @link https://docs.octobercms.com/3.x/extend/system/models.html
 */
class Code extends Model
{
    use \October\Rain\Database\Traits\Validation;

    /**
     * @var string table name
     */
    public $table = 'mates_code_codes';

    /**
     * @var array rules for validation
     */
    public $rules = [];

    public $belongsTo = [

        'room' => [
            Room::class
        ]
    ];

}
