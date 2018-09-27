<?php namespace App\Models\CustomRole;

/**
 * Class CustomRole
 *
 * @author Anuj Jaha ( er.anujjaha@gmail.com)
 */

use App\Models\BaseModel;
use App\Models\CustomRole\Traits\Attribute\Attribute;
use App\Models\CustomRole\Traits\Relationship\Relationship;

class CustomRole extends BaseModel
{
    use Attribute, Relationship;
    /**
     * Database Table
     *
     */
    protected $table = "roles";

    /**
     * Fillable Database Fields
     *
     */
    protected $fillable = [
        "id", "name", "all", "sort", "created_at", "updated_at", 
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