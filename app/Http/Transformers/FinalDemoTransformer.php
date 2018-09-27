<?php
namespace App\Http\Transformers;

use App\Http\Transformers;

class FinalDemoTransformer extends Transformer
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
            "finaldemoId" => (int) $item->id, "finaldemoName" =>  $item->name, "finaldemoTitle" =>  $item->title, "finaldemoAge" =>  $item->age, "finaldemoSalary" =>  $item->salary, 
        ];
    }
}