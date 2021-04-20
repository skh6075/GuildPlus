<?php

namespace skh6075\guildplus\guild;

final class GuildMarketProcess{

    private Guild $guild;

    private int $point;

    public function __construct(Guild $guild, array $data) {
        $this->guild = $guild;

        $this->point = $data["point"];
    }

    public function jsonSerialize(): array{
        return [
            "market" => [
                "point" => $this->point
            ]
        ];
    }

    public function getPoint(): int{
        return $this->point;
    }

    public function setPoint(int $point): void{
        $this->point = $point;
    }
}