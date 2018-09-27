<?php
namespace App\Http\Transformers;

use App\Http\Transformers;

class MyNewDemoTransformer extends Transformer
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
            "mynewdemoId" => (int) $item->id, "mynewdemoName" =>  $item->name, "mynewdemoTitle" =>  $item->title, "mynewdemoAge" =>  $item->age, 
        ];
    }
}