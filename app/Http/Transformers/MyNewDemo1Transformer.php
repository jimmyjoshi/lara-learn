<?php
namespace App\Http\Transformers;

use App\Http\Transformers;

class MyNewDemo1Transformer extends Transformer
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
            "mynewdemo1Id" => (int) $item->id, "mynewdemo1Name" =>  $item->name, "mynewdemo1Title" =>  $item->title, "mynewdemo1Age" =>  $item->age, 
        ];
    }
}