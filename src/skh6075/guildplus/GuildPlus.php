<?php

namespace skh6075\guildplus;

use pocketmine\player\Player;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\SingletonTrait;
use skh6075\guildplus\guild\Guild;
use skh6075\guildplus\lang\PluginLang;

final class GuildPlus extends PluginBase{
    use SingletonTrait;

    /** @var Guild[] */
    private static array $guilds = [];

    protected function onLoad(): void{
        self::setInstance($this);
    }

    protected function onEnable(): void{
        mkdir($this->getDataFolder() . "guilds/");

        $this->saveResource("lang/kor.yml");
        $this->saveResource("lang/eng.yml");

        $lang = $this->getServer()->getLanguage()->getLang();

        PluginLang::getInstance()->setDefaultProperties($lang, yaml_parse(file_get_contents($this->getDataFolder() . "lang/" . $lang . ".yml")));

        foreach (array_diff(scandir($this->getDataFolder() . "guilds/"), ['.', '..']) as $value) {
            if (pathinfo($value)[PATHINFO_EXTENSION] !== "json")
                continue;

            $data = json_decode(file_get_contents($this->getDataFolder() . "guilds/" . $value), true);
            $class = Guild::jsonDeserialize($data);
            self::$guilds[$class->getName()] = $class;
        }
    }

    protected function onDisable(): void{
        $savedCount = 0;
        foreach (self::$guilds as $guild) {
            file_put_contents($this->getDataFolder() . "guilds/" . $guild->getName() . ".json", json_encode($guild->jsonSerialize(), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
            $savedCount ++;
        }

        $this->getLogger()->alert(PluginLang::getInstance()->format("save.guild.message", ["%count%" => $savedCount], false));
    }

    public function getGuild(string $name): ?Guild{
        return self::$guilds[$name] ?? null;
    }

    public function addGuild(Player $player, string $name): void{
        self::$guilds[$name] = Guild::jsonDeserialize([
            "guildName" => $name,
            "owner" => $player->getName(),
            "co_owner" => [],
            "member" => [],
            "guildLevel" => 1,
            "guildExperience" => 0.0,
            "market" => ["point" => 0]
        ]);
    }

    public function getGuilds(): array{
        return self::$guilds;
    }
}