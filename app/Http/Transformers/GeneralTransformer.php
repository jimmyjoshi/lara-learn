<?php
namespace App\Http\Transformers;

use App\Http\Transformers;

class GeneralTransformer extends Transformer
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
            "generalId" => (int) $item->id, "generalName" =>  $item->name, "generalAge" =>  $item->age, "generalColor" =>  $item->color, 
        ];
    }
}