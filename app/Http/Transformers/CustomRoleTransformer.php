<?php
namespace App\Http\Transformers;

use App\Http\Transformers;

class CustomRoleTransformer extends Transformer
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
            "customroleId" => (int) $item->id, "customroleName" =>  $item->name, "customroleAll" =>  $item->all, "customroleSort" =>  $item->sort, "customroleCreatedAt" =>  $item->created_at, "customroleUpdatedAt" =>  $item->updated_at, 
        ];
    }
}