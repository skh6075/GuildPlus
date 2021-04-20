<?php

namespace skh6075\guildplus\event\level;

use skh6075\guildplus\event\GuildEvent;
use skh6075\guildplus\guild\Guild;

final class GuildLevelUpdateEvent extends GuildEvent{

    public const TYPE_NONE = 0;
    public const TYPE_INCREASE = 1;
    public const TYPE_DECREASE = 2;

    private int $beforeLevel;

    private int $afterLevel;

    private int $type;

    public function __construct(Guild $guild, int $beforeLevel, int $afterLevel) {
        parent::__construct($guild);
        $this->beforeLevel = $beforeLevel;
        $this->afterLevel = $afterLevel;

        $type = self::TYPE_NONE;
        if ($this->beforeLevel < $afterLevel) $type = self::TYPE_INCREASE;
        if ($this->beforeLevel > $afterLevel) $type = self::TYPE_DECREASE;

        $this->type = $type;
    }

    public function getBeforeLevel(): int{
        return $this->beforeLevel;
    }

    public function getAfterLevel(): int{
        return $this->afterLevel;
    }

    public function getType(): int{
        return $this->type;
    }
}