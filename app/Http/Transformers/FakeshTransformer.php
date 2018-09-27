<?php
namespace App\Http\Transformers;

use App\Http\Transformers;

class FakeshTransformer extends Transformer
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
            "fakeshId" => (int) $item->id, "fakeshName" =>  $item->name, "fakeshTitle" =>  $item->title, "fakeshAge" =>  $item->age, "fakeshBdate" =>  $item->bdate, 
        ];
    }
}