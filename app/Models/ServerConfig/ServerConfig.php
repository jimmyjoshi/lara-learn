<?php namespace App\Models\ServerConfig;

/**
 * Class ServerConfig
 *
 * @author Anuj Jaha er.anujjaha@gmail.com
 */

use App\Models\BaseModel;
use App\Models\ServerConfig\Traits\Relationship\Relationship;

class ServerConfig extends BaseModel
{
    use Relationship;
    /**
     * Database Table
     *
     */
    protected $table = "data_smtp_server_configs";

    /**
     * Fillable Database Fields
     *
     */
    protected $fillable = [
        'user_id',
        'domain',
        'host',
        'username',
        'password',
        'set_from',
        'set_from_name',
        'reply_to',
        'reply_to_name',
        'max_limit',
        'notes',
        'status',
    ];

    /**
     * Guarded ID Column
     *
     */
    protected $guarded = ["id"];
}