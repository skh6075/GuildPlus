<?php

namespace skh6075\guildplus\guild;

use skh6075\guildplus\event\level\experience\DecreaseGuildExperienceEventEvent;
use skh6075\guildplus\event\level\experience\IncreaseGuildExperienceEvent;
use skh6075\guildplus\event\level\GuildLevelUpdateEvent;

final class GuildLevelProcess{

    public const LEVEL_POUND = 2000;

    private Guild $guild;

    private int $guildLevel;

    private float $guildExperience;

    public function __construct(Guild $guild, int $guildLevel, int $guildExperience) {
        $this->guild = $guild;
        $this->guildLevel = $guildLevel;
        $this->guildExperience = $guildExperience;
    }

    public function jsonSerialize(): array{
        return [
            "guildLevel" => $this->guildLevel,
            "guildExperience" => $this->guildExperience
        ];
    }

    public function getLevel(): int{
        return $this->guildLevel;
    }

    public function setLevel(int $level): void{
        $ev = new GuildLevelUpdateEvent($this->guild, $this->guildLevel, $level);
        $ev->call();
        if ($ev->isCancelled())
            return;

        $this->guildLevel = $ev->getAfterLevel();
    }

    public function getExperience(): float{
        return $this->guildExperience;
    }

    public function addExperience(float $amount): void{
        $ev = new IncreaseGuildExperienceEvent($this->guild, $amount);
        $ev->call();
        if ($ev->isCancelled())
            return;

        $this->guildExperience += $ev->getAmount();
        while ($this->guildExperience >= $this->getMaxExperience()) {
            $this->guildExperience -= $this->getMaxExperience();
            $this->setLevel($this->getLevel() + 1);
        }
    }

    public function decreaseExperience(float $amount): void{
        $ev = new DecreaseGuildExperienceEventEvent($this->guild, $amount);
        $ev->call();
        if ($ev->isCancelled())
            return;

        $this->guildExperience -= $ev->getAmount();
    }

    public function getMaxExperience(): float{
        return $this->guildLevel * self::LEVEL_POUND;
    }
}