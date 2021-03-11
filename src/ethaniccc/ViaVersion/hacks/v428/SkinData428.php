<?php

namespace ethaniccc\ViaVersion\hacks\v428;

use pocketmine\network\mcpe\protocol\types\SkinData;
use pocketmine\network\mcpe\protocol\types\SkinImage;

class SkinData428 extends SkinData{

    public static function from(SkinData $d, string $fabID) : SkinData428{
        return new SkinData428($fabID, $d->getSkinId(), $d->getResourcePatch(), $d->getSkinImage(), $d->getAnimations(), $d->getCapeImage(), $d->getGeometryData(), $d->getAnimationData(), $d->isPremium(), $d->isPersona(), $d->isPersonaCapeOnClassic(), $d->getCapeId(), $d->getFullSkinId(), $d->getArmSize(), $d->getSkinColor(), $d->getPersonaPieces(), $d->getPieceTintColors(), $d->isVerified());
    }

    public $fabID;

    public function __construct(string $fabID, string $skinId, string $resourcePatch, SkinImage $skinImage, array $animations = [], SkinImage $capeImage = null, string $geometryData = "", string $animationData = "", bool $premium = false, bool $persona = false, bool $personaCapeOnClassic = false, string $capeId = "", ?string $fullSkinId = null, string $armSize = self::ARM_SIZE_WIDE, string $skinColor = "", array $personaPieces = [], array $pieceTintColors = [], bool $isVerified = true){
        parent::__construct($skinId, $resourcePatch, $skinImage, $animations, $capeImage, $geometryData, $animationData, $premium, $persona, $personaCapeOnClassic, $capeId, $fullSkinId, $armSize, $skinColor, $personaPieces, $pieceTintColors, $isVerified);
        $this->fabID = $fabID;
    }

    public function getFabID() : string{
        return $this->fabID;
    }

}