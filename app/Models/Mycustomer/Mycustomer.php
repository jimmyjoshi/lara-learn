<?php namespace App\Models\Mycustomer;

/**
 * Class Mycustomer
 *
 * @author Anuj Jaha ( er.anujjaha@gmail.com)
 */

use App\Models\BaseModel;
use App\Models\Mycustomer\Traits\Attribute\Attribute;
use App\Models\Mycustomer\Traits\Relationship\Relationship;

class Mycustomer extends BaseModel
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
     * Fillable Database Fields
     *
     */
    public $timestamps = false;

    /**
     * Guarded ID Column
     *
     */
    protected $guarded = ["id"];
}