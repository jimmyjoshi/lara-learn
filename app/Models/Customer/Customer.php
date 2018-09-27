<?php namespace App\Models\Customer;

/**
 * Class Customer
 *
 * @author Anuj Jaha ( er.anujjaha@gmail.com)
 */

use App\Models\BaseModel;
use App\Models\Customer\Traits\Attribute\Attribute;
use App\Models\Customer\Traits\Relationship\Relationship;

class Customer extends BaseModel
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
     * Guarded ID Column
     *
     */
    protected $guarded = ["id"];
}