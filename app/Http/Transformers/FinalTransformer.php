<?php
namespace App\Http\Transformers;

use App\Http\Transformers;

class FinalTransformer extends Transformer
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
            "finalId" => (int) $item->id, "finalName" =>  $item->name, "finalTitle" =>  $item->title, "finalAge" =>  $item->age, "finalSalary" =>  $item->salary, 
        ];
    }
}