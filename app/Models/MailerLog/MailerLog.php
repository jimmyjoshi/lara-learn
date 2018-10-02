<?php namespace App\Models\MailerLog;

/**
 * Class MailerLog
 *
 * @author Anuj Jaha ( er.anujjaha@gmail.com)
 */

use App\Models\BaseModel;
use App\Models\MailerLog\Traits\Attribute\Attribute;
use App\Models\MailerLog\Traits\Relationship\Relationship;

class MailerLog extends BaseModel
{
    use Attribute, Relationship;
    /**
     * Database Table
     *
     */
    protected $table = "data_mailers_log";

    /**
     * Fillable Database Fields
     *
     */
    protected $fillable = [
        "id", "mailer_id", "subscriber_id", "subject", "body", "read_at", "created_at", "updated_at",
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