<?php

namespace ethaniccc\ViaVersion\hacks\v428;

use pocketmine\network\mcpe\protocol\PlayerListPacket;
use pocketmine\network\mcpe\protocol\types\PlayerListEntry;
use pocketmine\network\mcpe\protocol\types\SkinData;
use pocketmine\network\mcpe\protocol\types\SkinImage;

class PlayerListPacket428 extends PlayerListPacket{

    public function putSkin(SkinData $skin){
        $this->putString($skin->getSkinId());
        $this->putString($skin->getFabID());
        $this->putString($skin->getResourcePatch());
        $this->putSkinImage($skin->getSkinImage());
        $this->putLInt(count($skin->getAnimations()));
        foreach($skin->getAnimations() as $animation){
            $this->putSkinImage($animation->getImage());
            $this->putLInt($animation->getType());
            $this->putLFloat($animation->getFrames());
        }
        $this->putSkinImage($skin->getCapeImage());
        $this->putString($skin->getGeometryData());
        $this->putString($skin->getAnimationData());
        $this->putBool($skin->isPremium());
        $this->putBool($skin->isPersona());
        $this->putBool($skin->isPersonaCapeOnClassic());
        $this->putString($skin->getCapeId());
        $this->putString($skin->getFullSkinId());
        $this->putString($skin->getArmSize());
        $this->putString($skin->getSkinColor());
        $this->putLInt(count($skin->getPersonaPieces()));
        foreach($skin->getPersonaPieces() as $piece){
            $this->putString($piece->getPieceId());
            $this->putString($piece->getPieceType());
            $this->putString($piece->getPackId());
            $this->putBool($piece->isDefaultPiece());
            $this->putString($piece->getProductId());
        }
        $this->putLInt(count($skin->getPieceTintColors()));
        foreach($skin->getPieceTintColors() as $tint){
            $this->putString($tint->getPieceType());
            $this->putLInt(count($tint->getColors()));
            foreach($tint->getColors() as $color){
                $this->putString($color);
            }
        }
    }

    private function putSkinImage(SkinImage $image) : void{
        $this->putLInt($image->getWidth());
        $this->putLInt($image->getHeight());
        $this->putString($image->getData());
    }

    protected function decodePayload(){
        $this->type = $this->getByte();
        $count = $this->getUnsignedVarInt();
        for($i = 0; $i < $count; ++$i){
            $entry = new PlayerListEntry();

            if($this->type === self::TYPE_ADD){
                $entry->uuid = $this->getUUID();
                $entry->entityUniqueId = $this->getEntityUniqueId();
                $entry->username = $this->getString();
                $entry->xboxUserId = $this->getString();
                $entry->platformChatId = $this->getString();
                $entry->buildPlatform = $this->getLInt();
                $entry->skinData = $this->getSkin();
                $entry->isTeacher = $this->getBool();
                $entry->isHost = $this->getBool();
            }else{
                $entry->uuid = $this->getUUID();
            }

            $this->entries[$i] = $entry;
        }
        if($this->type === self::TYPE_ADD){
            for($i = 0; $i < $count; ++$i){
                $this->entries[$i]->skinData->setVerified($this->getBool());
            }
        }
    }

    protected function encodePayload(){
        $this->putByte($this->type);
        $this->putUnsignedVarInt(count($this->entries));
        foreach($this->entries as $entry){
            if($this->type === self::TYPE_ADD){
                $this->putUUID($entry->uuid);
                $this->putEntityUniqueId($entry->entityUniqueId);
                $this->putString($entry->username);
                $this->putString($entry->xboxUserId);
                $this->putString($entry->platformChatId);
                $this->putLInt($entry->buildPlatform);
                $this->putSkin($entry->skinData);
                $this->putBool($entry->isTeacher);
                $this->putBool($entry->isHost);
            }else{
                $this->putUUID($entry->uuid);
            }
        }
        if($this->type === self::TYPE_ADD){
            foreach($this->entries as $entry){
                $this->putBool($entry->skinData->isVerified());
            }
        }
    }

}