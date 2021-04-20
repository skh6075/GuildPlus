<?php

namespace skh6075\guildplus\guild;

final class Guild implements \JsonSerializable{

    private string $guildName;

    private GuildLevelProcess $levelProcess;

    private GuildMarketProcess $marketProcess;

    private string $owner;

    private array $co_owner = [];

    private array $member = [];

    public function __construct(string $guildName, string $owner, array $co_owner, array $member, int $guildLevel, float $guildExperience, array $marketData) {
        $this->guildName = $guildName;
        $this->owner = $owner;
        $this->co_owner = $co_owner;
        $this->member = $member;

        $this->levelProcess = new GuildLevelProcess($this, $guildLevel, $guildExperience);
        $this->marketProcess = new GuildMarketProcess($this, $marketData);
    }

    public static function jsonDeserialize(array $data): self{
        return new Guild(
            (string) $data["guildName"],
            (string) $data["owner"],
            (array) $data["co_owner"],
            (array) $data["member"],
            (int) $data["guildLevel"],
            (float) $data["guildExperience"],
            (array) $data["market"]
        );
    }

    public function jsonSerialize(): array{
        return [
            "guildName" => $this->guildName,
            "owner" => $this->owner,
            "co_owner" => $this->co_owner,
            "member" => $this->member
        ] + $this->levelProcess->jsonSerialize();
    }

    public function getName(): string{
        return $this->guildName;
    }

    public function isJoinedPlayer(string $name): bool{
        $accessor = [$this->owner] + $this->co_owner + $this->member;
        return in_array($name, $accessor);
    }
    
    public function getLevelProcess(): GuildLevelProcess{
        return $this->levelProcess;
    }
}
