<?php

namespace App\Actions;
use App\Models\StoreSocialMediaLink;



class SocialMediaLinksActions 
{
    public function __construct(
        private StoreSocialMediaLink $socialLinks
    ){}

    public function createSocialMediaLinksRecord($createSocialMediaLinkRecordOptions)
    {
        $data = $createSocialMediaLinkRecordOptions['create_payload'];

        return $this->socialLinks->create($data);
    }

    public function updateSocialMediaLinkRecord($updateSocialMediaLinkRecordOptions)
    {
        $entity_id = $updateSocialMediaLinkRecordOptions['entity_id'];
        $data =  $updateSocialMediaLinkRecordOptions['update_payload'];

        return $this->socialLinks->update($data);
    }

    public function getSocialMediaLinkRecord($entity_id)
    {
        
    }
}