<?php
namespace App\Http\Transformers;

use App\Http\Transformers;

class ConfigTransformer extends Transformer
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
            "configId" => (int) $item->id, "configUserId" =>  $item->user_id, "configDomain" =>  $item->domain, "configHost" =>  $item->host, "configUsername" =>  $item->username, "configPassword" =>  $item->password, "configSetFrom" =>  $item->set_from, "configSetFromName" =>  $item->set_from_name, "configReplyTo" =>  $item->reply_to, "configReplyToName" =>  $item->reply_to_name, "configMaxLimit" =>  $item->max_limit, "configNotes" =>  $item->notes, "configStatus" =>  $item->status, "configCreatedAt" =>  $item->created_at, "configUpdatedAt" =>  $item->updated_at, 
        ];
    }
}