<?php
namespace App\Http\Transformers;

use App\Http\Transformers;

class MyDemoTransformer extends Transformer
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
            "MyDemoId" => (int) $item->id, "MyDemoName" =>  $item->name, "MyDemoAge" =>  $item->age, "MyDemoAddress" =>  $item->address, 
        ];
    }
}