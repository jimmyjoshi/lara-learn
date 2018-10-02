<?php
namespace App\Http\Transformers;

use App\Http\Transformers;

class MailerLogTransformer extends Transformer
{
    /**
     * Transform
     *
     * @param array $data
     * @return array
     */
    public function transform($item)
    {
        if(is_array($item))
        {
            $item = (object)$item;
        }

        return [
            "mailerlogId" => (int) $item->id, "mailerlogSubscriberId" =>  $item->subscriber_id, "mailerlogSubject" =>  $item->subject, "mailerlogBody" =>  $item->body, "mailerlogCreatedAt" =>  $item->created_at, "mailerlogUpdatedAt" =>  $item->updated_at, 
        ];
    }
}