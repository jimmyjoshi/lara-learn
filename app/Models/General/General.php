<?php namespace App\Models\General;

/**
 * Class General
 *
 * @author Anuj Jaha ( er.anujjaha@gmail.com)
 */

use App\Models\BaseModel;
use App\Models\General\Traits\Attribute\Attribute;
use App\Models\General\Traits\Relationship\Relationship;

class General extends BaseModel
{
    use Attribute, Relationship;
    /**
     * Database Table
     *
     */
    protected $table = "general";

    /**
     * Fillable Database Fields
     *
     */
    protected $fillable = [
        "id", "name", "age", "color", 
    ];

    /**
     * Timestamp flag
     *
     */
    public $timestamps = false;

    /**
     * Guarded ID Column
     *
     */
    protected $guarded = ["id"];
}