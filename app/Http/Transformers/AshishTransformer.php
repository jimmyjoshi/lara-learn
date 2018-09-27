<?php
namespace App\Http\Transformers;

use App\Http\Transformers;

class AshishTransformer extends Transformer
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
            "ashishId" => (int) $item->id, "ashishAge" =>  $item->age, "ashishName" =>  $item->name, "ashishColor" =>  $item->color, "ashishTotal" =>  $item->total, 
        ];
    }
}