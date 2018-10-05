<?php namespace App\Models\Config;

/**
 * Class Config
 *
 * @author Anuj Jaha ( er.anujjaha@gmail.com)
 */

use App\Models\BaseModel;
use App\Models\Config\Traits\Attribute\Attribute;
use App\Models\Config\Traits\Relationship\Relationship;

class Config extends BaseModel
{
    use Attribute, Relationship;
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
        "id", "user_id", "domain", "host", "username", "password", "set_from", "set_from_name", "reply_to", "reply_to_name", "max_limit", "notes", "status", "created_at", "updated_at", 
    ];

    /**
     * Timestamp flag
     *
     */
    public $timestamps = true;

    /**
     * Guarded ID Column
     *
     */
    protected $guarded = ["id"];
}