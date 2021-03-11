<?php

namespace ethaniccc\ViaVersion\hacks\v428;

use pocketmine\nbt\NetworkLittleEndianNBTStream;
use pocketmine\network\mcpe\protocol\StartGamePacket;
use pocketmine\network\mcpe\protocol\types\BlockPaletteEntry;
use pocketmine\network\mcpe\protocol\types\Experiments;
use pocketmine\network\mcpe\protocol\types\ItemTypeEntry;
use pocketmine\network\mcpe\protocol\types\SpawnSettings;

class StartGamePacket428 extends StartGamePacket{

    public static function from(StartGamePacket $packet) : StartGamePacket428{
        $s = new StartGamePacket428();
        $s->entityRuntimeId = $packet->entityRuntimeId;
        $s->entityUniqueId = $packet->entityUniqueId;
        $s->playerGamemode = $packet->playerGamemode;
        $s->playerPosition = $packet->playerPosition;
        $s->pitch = $packet->pitch;
        $s->yaw = $packet->yaw;
        $s->seed = $packet->seed;
        $s->spawnSettings = $packet->spawnSettings;
        $s->generator = $packet->generator;
        $s->worldGamemode = $packet->worldGamemode;
        $s->difficulty = $packet->difficulty;
        $s->spawnX = $packet->spawnX;
        $s->spawnY = $packet->spawnY;
        $s->spawnZ = $packet->spawnZ;
        $s->hasAchievementsDisabled = $packet->hasAchievementsDisabled;
        $s->time = $packet->time;
        $s->eduEditionOffer = $packet->eduEditionOffer;
        $s->hasEduFeaturesEnabled = $packet->hasEduFeaturesEnabled;
        $s->eduProductUUID = $packet->eduProductUUID;
        $s->rainLevel = $packet->rainLevel;
        $s->lightningLevel = $packet->lightningLevel;
        $s->hasConfirmedPlatformLockedContent = $packet->hasConfirmedPlatformLockedContent;
        $s->isMultiplayerGame = $packet->isMultiplayerGame;
        $s->hasLANBroadcast = $packet->hasLANBroadcast;
        $s->xboxLiveBroadcastMode = $packet->xboxLiveBroadcastMode;
        $s->platformBroadcastMode = $packet->platformBroadcastMode;
        $s->commandsEnabled = $packet->commandsEnabled;
        $s->isTexturePacksRequired = $packet->isTexturePacksRequired;
        $s->gameRules = $packet->gameRules;
        $s->experiments = $packet->experiments;
        $s->hasBonusChestEnabled = $packet->hasBonusChestEnabled;
        $s->hasStartWithMapEnabled = $packet->hasStartWithMapEnabled;
        $s->defaultPlayerPermission = $packet->defaultPlayerPermission;
        $s->serverChunkTickRadius = $packet->serverChunkTickRadius;
        $s->hasLockedBehaviorPack = $packet->hasLockedBehaviorPack;
        $s->hasLockedResourcePack = $packet->hasLockedResourcePack;
        $s->isFromLockedWorldTemplate = $packet->isFromLockedWorldTemplate;
        $s->useMsaGamertagsOnly = $packet->useMsaGamertagsOnly;
        $s->isFromWorldTemplate = $packet->isFromWorldTemplate;
        $s->isWorldTemplateOptionLocked = $packet->isWorldTemplateOptionLocked;
        $s->onlySpawnV1Villagers = $packet->onlySpawnV1Villagers;
        $s->vanillaVersion = "1.16.210";
        $s->limitedWorldWidth = $packet->limitedWorldWidth;
        $s->limitedWorldLength = $packet->limitedWorldLength;
        $s->isNewNether = $packet->isNewNether;
        $s->experimentalGameplayOverride = $packet->experimentalGameplayOverride;
        $s->levelId = $packet->levelId;
        $s->worldName = $packet->worldName;
        $s->premiumWorldTemplateId = $packet->premiumWorldTemplateId;
        $s->isTrial = $packet->isTrial;
        $s->playerMovementType = $packet->playerMovementType;
        $s->currentTick = $packet->currentTick;
        $s->enchantmentSeed = $packet->enchantmentSeed;
        $s->multiplayerCorrelationId = $packet->multiplayerCorrelationId;
        $s->blockPalette = $packet->blockPalette;
        $s->itemTable = $packet->itemTable;
        $s->enableNewInventorySystem = $packet->enableNewInventorySystem;
        // please fucking end my suffering
        return $s;
    }

    public $rewindHistorySize = 0;
    public $isServerAuthoritativeBlockBreaking = false;

    protected function decodePayload(){
        $this->entityUniqueId = $this->getEntityUniqueId();
        $this->entityRuntimeId = $this->getEntityRuntimeId();
        $this->playerGamemode = $this->getVarInt();

        $this->playerPosition = $this->getVector3();

        $this->pitch = $this->getLFloat();
        $this->yaw = $this->getLFloat();

        //Level settings
        $this->seed = $this->getVarInt();
        $this->spawnSettings = SpawnSettings::read($this);
        $this->generator = $this->getVarInt();
        $this->worldGamemode = $this->getVarInt();
        $this->difficulty = $this->getVarInt();
        $this->getBlockPosition($this->spawnX, $this->spawnY, $this->spawnZ);
        $this->hasAchievementsDisabled = $this->getBool();
        $this->time = $this->getVarInt();
        $this->eduEditionOffer = $this->getVarInt();
        $this->hasEduFeaturesEnabled = $this->getBool();
        $this->eduProductUUID = $this->getString();
        $this->rainLevel = $this->getLFloat();
        $this->lightningLevel = $this->getLFloat();
        $this->hasConfirmedPlatformLockedContent = $this->getBool();
        $this->isMultiplayerGame = $this->getBool();
        $this->hasLANBroadcast = $this->getBool();
        $this->xboxLiveBroadcastMode = $this->getVarInt();
        $this->platformBroadcastMode = $this->getVarInt();
        $this->commandsEnabled = $this->getBool();
        $this->isTexturePacksRequired = $this->getBool();
        $this->gameRules = $this->getGameRules();
        $this->experiments = Experiments::read($this);
        $this->hasBonusChestEnabled = $this->getBool();
        $this->hasStartWithMapEnabled = $this->getBool();
        $this->defaultPlayerPermission = $this->getVarInt();
        $this->serverChunkTickRadius = $this->getLInt();
        $this->hasLockedBehaviorPack = $this->getBool();
        $this->hasLockedResourcePack = $this->getBool();
        $this->isFromLockedWorldTemplate = $this->getBool();
        $this->useMsaGamertagsOnly = $this->getBool();
        $this->isFromWorldTemplate = $this->getBool();
        $this->isWorldTemplateOptionLocked = $this->getBool();
        $this->onlySpawnV1Villagers = $this->getBool();
        $this->vanillaVersion = $this->getString();
        $this->limitedWorldWidth = $this->getLInt();
        $this->limitedWorldLength = $this->getLInt();
        $this->isNewNether = $this->getBool();
        if($this->getBool()){
            $this->experimentalGameplayOverride = $this->getBool();
        }else{
            $this->experimentalGameplayOverride = null;
        }

        $this->levelId = $this->getString();
        $this->worldName = $this->getString();
        $this->premiumWorldTemplateId = $this->getString();
        $this->isTrial = $this->getBool();
        $this->playerMovementType = $this->getVarInt();
        $this->rewindHistorySize = $this->getVarInt();
        $this->isServerAuthoritativeBlockBreaking = $this->getBool();
        $this->currentTick = $this->getLLong();

        $this->enchantmentSeed = $this->getVarInt();

        $this->blockPalette = [];
        for($i = 0, $len = $this->getUnsignedVarInt(); $i < $len; ++$i){
            $blockName = $this->getString();
            $state = $this->getNbtCompoundRoot();
            $this->blockPalette[] = new BlockPaletteEntry($blockName, $state);
        }

        $this->itemTable = [];
        for($i = 0, $count = $this->getUnsignedVarInt(); $i < $count; ++$i){
            $stringId = $this->getString();
            $numericId = $this->getSignedLShort();
            $isComponentBased = $this->getBool();

            $this->itemTable[] = new ItemTypeEntry($stringId, $numericId, $isComponentBased);
        }

        $this->multiplayerCorrelationId = $this->getString();
        $this->enableNewInventorySystem = $this->getBool();
    }

    protected function encodePayload(){
        $this->putEntityUniqueId($this->entityUniqueId);
        $this->putEntityRuntimeId($this->entityRuntimeId);
        $this->putVarInt($this->playerGamemode);

        $this->putVector3($this->playerPosition);

        $this->putLFloat($this->pitch);
        $this->putLFloat($this->yaw);

        //Level settings
        $this->putVarInt($this->seed);
        $this->spawnSettings->write($this);
        $this->putVarInt($this->generator);
        $this->putVarInt($this->worldGamemode);
        $this->putVarInt($this->difficulty);
        $this->putBlockPosition($this->spawnX, $this->spawnY, $this->spawnZ);
        $this->putBool($this->hasAchievementsDisabled);
        $this->putVarInt($this->time);
        $this->putVarInt($this->eduEditionOffer);
        $this->putBool($this->hasEduFeaturesEnabled);
        $this->putString($this->eduProductUUID);
        $this->putLFloat($this->rainLevel);
        $this->putLFloat($this->lightningLevel);
        $this->putBool($this->hasConfirmedPlatformLockedContent);
        $this->putBool($this->isMultiplayerGame);
        $this->putBool($this->hasLANBroadcast);
        $this->putVarInt($this->xboxLiveBroadcastMode);
        $this->putVarInt($this->platformBroadcastMode);
        $this->putBool($this->commandsEnabled);
        $this->putBool($this->isTexturePacksRequired);
        $this->putGameRules($this->gameRules);
        $this->experiments->write($this);
        $this->putBool($this->hasBonusChestEnabled);
        $this->putBool($this->hasStartWithMapEnabled);
        $this->putVarInt($this->defaultPlayerPermission);
        $this->putLInt($this->serverChunkTickRadius);
        $this->putBool($this->hasLockedBehaviorPack);
        $this->putBool($this->hasLockedResourcePack);
        $this->putBool($this->isFromLockedWorldTemplate);
        $this->putBool($this->useMsaGamertagsOnly);
        $this->putBool($this->isFromWorldTemplate);
        $this->putBool($this->isWorldTemplateOptionLocked);
        $this->putBool($this->onlySpawnV1Villagers);
        $this->putString($this->vanillaVersion);
        $this->putLInt($this->limitedWorldWidth);
        $this->putLInt($this->limitedWorldLength);
        $this->putBool($this->isNewNether);
        $this->putBool($this->experimentalGameplayOverride !== null);
        if($this->experimentalGameplayOverride !== null){
            $this->putBool($this->experimentalGameplayOverride);
        }

        $this->putString($this->levelId);
        $this->putString($this->worldName);
        $this->putString($this->premiumWorldTemplateId);
        $this->putBool($this->isTrial);
        $this->putVarInt($this->playerMovementType);
        $this->putVarInt($this->rewindHistorySize);
        $this->putBool($this->isServerAuthoritativeBlockBreaking);
        $this->putLLong($this->currentTick);

        $this->putVarInt($this->enchantmentSeed);

        $this->putUnsignedVarInt(count($this->blockPalette));
        $nbtWriter = new NetworkLittleEndianNBTStream();
        foreach($this->blockPalette as $entry){
            $this->putString($entry->getName());
            $this->put($nbtWriter->write($entry->getStates()));
        }
        $this->putUnsignedVarInt(count($this->itemTable));
        foreach($this->itemTable as $entry){
            $this->putString($entry->getStringId());
            $this->putLShort($entry->getNumericId());
            $this->putBool($entry->isComponentBased());
        }

        $this->putString($this->multiplayerCorrelationId);
        $this->putBool($this->enableNewInventorySystem);
    }

}