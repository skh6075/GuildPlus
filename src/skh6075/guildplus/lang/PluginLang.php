<?php

namespace skh6075\guildplus\lang;

use pocketmine\utils\SingletonTrait;

final class PluginLang{
    use SingletonTrait;

    private string $lang;

    private array $translates = [];

    public function __construct() {
        self::setInstance($this);
    }

    public function setDefaultProperties(string $lang, array $translates = []): void{
        $this->lang = $lang;
        $this->translates = $translates;
    }

    public function format(string $key, array $replaces = [], bool $pushPrefix = true): string{
        $format = $pushPrefix ? $this->translates["prefix"] ?? "" : "";
        $format .= $this->translates[$key] ?? "";

        foreach ($replaces as $old => $new) {
            $format = str_replace($old, $new, $format);
        }

        return $format;
    }
}