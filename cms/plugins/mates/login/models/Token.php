<?php namespace Mates\Login\Models;

use Model;

/**
 * Token Model
 *
 * @link https://docs.octobercms.com/3.x/extend/system/models.html
 */
class Token extends Model
{
    use \October\Rain\Database\Traits\Validation;

    /**
     * @var string table name
     */
    public $table = 'mates_login_tokens';

    /**
     * @var array rules for validation
     */
    public $rules = [];
}
