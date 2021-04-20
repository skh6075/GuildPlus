<?php

namespace skh6075\guildplus\event\level\experience;

use skh6075\guildplus\event\GuildEvent;
use skh6075\guildplus\guild\Guild;

class GuildExperienceEvent extends GuildEvent{

    private float $amount;

    public function __construct(Guild $guild, float $amount) {
        parent::__construct($guild);
        $this->amount = $amount;
    }

    final public function getAmount(): float{
        return $this->amount;
    }

    final public function setAmount(float $amount): void{
        $this->amount = $amount;
    }
}