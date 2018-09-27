<?php
namespace App\Http\Transformers;

use App\Http\Transformers;

class EventTransformer extends Transformer
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
            'eventId'           => (int) $item->id,
            'eventName'         => $item->name,
            'eventTitle'        => $item->title
        ];
    }

    public function createEvent($model = null)
    {
        return [
            'eventId'           => (int) $model->id,
            'eventName'         => $model->name,
            'eventTitle'        => $model->title
        ];
    }
}