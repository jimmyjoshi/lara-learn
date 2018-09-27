<?php namespace App\Models\Sample;

/**
 * Class Sample
 *
 * @author Anuj Jaha ( er.anujjaha@gmail.com)
 */

use App\Models\BaseModel;
//use App\Models\Sample\Traits\Attribute\Attribute;
//use App\Models\Sample\Traits\Relationship\Relationship;

class Sample extends BaseModel
{
    //use Attribute, Relationship;
    /**
     * Database Table
     *
     */
    protected $table = "data_table_name";

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