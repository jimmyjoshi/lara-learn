<?php namespace App\Models\Demo;

/**
 * Class Demo
 *
 * @author Anuj Jaha ( er.anujjaha@gmail.com)
 */

use App\Models\BaseModel;
use App\Models\Demo\Traits\Attribute\Attribute;
use App\Models\Demo\Traits\Relationship\Relationship;

class Demo extends BaseModel
{
    use Attribute, Relationship;
    /**
     * Database Table
     *
     */
    protected $table = "customers";

    /**
     * Fillable Database Fields
     *
     */
    protected $fillable = [
        'id',
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