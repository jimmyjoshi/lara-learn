<?php
namespace App\Http\Transformers;

use App\Http\Transformers;

class SalaryTransformer extends Transformer
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
            "salaryId" => (int) $item->id, "salaryName" =>  $item->name, "salaryTitle" =>  $item->title, "salaryAge" =>  $item->age, "salaryBdate" =>  $item->bdate, 
        ];
    }
}