<?php

namespace skh6075\guildplus\api;

use pocketmine\player\Player;
use pocketmine\utils\SingletonTrait;
use skh6075\guildplus\guild\Guild;
use skh6075\guildplus\GuildPlus;

final class GuildAPI{
    use SingletonTrait;

    public function __construct() {
        self::setInstance($this);
    }

    public function getGuildByPlayer(Player $player): ?Guild{
        foreach (GuildPlus::getInstance()->getGuilds() as $guild) {
            if ($guild->isJoinedPlayer($player->getName()))
                return $guild;
        }

        return null;
    }
}