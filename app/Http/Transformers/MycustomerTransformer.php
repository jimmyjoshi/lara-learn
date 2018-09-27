<?php
namespace App\Http\Transformers;

use App\Http\Transformers;

class MycustomerTransformer extends Transformer
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
            "eventId" => (int) $item->id, "eventName" =>  $item->name, "eventTitle" =>  $item->title, "eventEventStartTime" =>  $item->event_start_time, "eventCreatedAt" =>  $item->created_at, "eventUpdatedAt" =>  $item->updated_at, 
        ];
    }
}