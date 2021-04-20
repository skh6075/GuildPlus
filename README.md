# GuildPlus
[PMMP] A Plugin implement Faction Guild API.

# Usage

> If you want to check the Player Guild?
```php
GuildAPI::getInstance()->getGuildByPlayer(Player $player);
```

> If you want to All Guilds?
```php
GuildPlus::getInstance()->getGuilds();
```

> If you want to create Guild?
```php
GuildPlus::getInstance()->addGuild(Player $ownerPlayer, string $guildName);
```

> If you want to get Guild?
```php
/** @var Guild|null $guild */
$guild = GuildPlus::getInstance()->getGuild(string $guildName);
```

> If you want to use Guild LevelProcess?
```php
$levelProcess = $guild->getLevelProocess();
$levelProcess->getLevel();
$levelProcess->getExperience();
$levelPrccess->addExperience(float $amount);
$levelProcess->decreaseExperience(float $amount);
```
