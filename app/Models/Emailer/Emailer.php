<?php namespace App\Models\Emailer;

/**
 * Class Emailer
 *
 * @author Anuj Jaha er.anujjaha@gmail.com
 */

use App\Models\BaseModel;
use App\Models\Emailer\Traits\Attribute\Attribute;
use App\Models\Emailer\Traits\Relationship\Relationship;
use Illuminate\Database\Eloquent\SoftDeletes;

class Emailer extends BaseModel
{
    use Attribute, Relationship, SoftDeletes;

    /**
     * Database Table
     *
     */
    protected $table = "data_mailers";

    /**
     * Timestamp
     *
     * @var boolean
     */
    public $timestamp = true;

    /**
     * Fillable Database Fields
     *
     */
    protected $fillable = [
        'server_id',
        'user_id',
        'subject',
        'body',
    ];

    /**
     * Guarded ID Column
     *
     */
    protected $guarded = ["id"];

    /**
     * Dates
     *
     * @var array
     */
    protected $dates = ['deleted_at'];
}