<?php

namespace skh6075\guildplus\event;

use pocketmine\event\Cancellable;
use pocketmine\event\CancellableTrait;
use pocketmine\event\Event;
use skh6075\guildplus\guild\Guild;

class GuildEvent extends Event implements Cancellable{
    use CancellableTrait;

    protected Guild $guild;

    public function __construct(Guild $guild) {
        $this->guild = $guild;
    }

    final public function getGuild(): Guild{
        return $this->guild;
    }

    final public function setGuild(Guild $guild): void{
        $this->guild = $guild;
    }
}