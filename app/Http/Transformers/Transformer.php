<?php

namespace App\Http\Transformers;

abstract class Transformer {

    public function transformCollection($items)
    {
        if(isset($items))
        {
            if(is_array($items))
            {
                return array_map([$this, 'transform'], $items);
            }

            $response = [];
            foreach($items as $item)
            {
                $response[] = $this->transform($item);
            }
            return $response;
        }

        return false;
    }

    public abstract function transform($item);

    public function nulltoBlank($data)
    {
        return $data ? $data : '';
    }
}
