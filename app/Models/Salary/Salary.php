<?php namespace App\Models\Salary;

/**
 * Class Salary
 *
 * @author Anuj Jaha ( er.anujjaha@gmail.com)
 */

use App\Models\BaseModel;
use App\Models\Salary\Traits\Attribute\Attribute;
use App\Models\Salary\Traits\Relationship\Relationship;

class Salary extends BaseModel
{
    use Attribute, Relationship;
    /**
     * Database Table
     *
     */
    protected $table = "data_fakesh";

    /**
     * Fillable Database Fields
     *
     */
    protected $fillable = [
        "id", "name", "title", "age", "bdate", 
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