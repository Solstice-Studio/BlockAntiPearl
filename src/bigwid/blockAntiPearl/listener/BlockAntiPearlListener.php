<?php

namespace bigwid\blockAntiPearl\listener;

use pocketmine\event\Listener;
use pocketmine\event\entity\ProjectileHitBlockEvent;
use pocketmine\item\StringToItemParser;
use pocketmine\player\Player;
use pocketmine\plugin\PluginBase;

class BlockAntiPearlListener implements Listener
{
    private array $blockedIds;
    private string $message;

    public function __construct(PluginBase $plugin)
    {
        $config = $plugin->getConfig();
        $this->message = $config->get("message");
        $parser = StringToItemParser::getInstance();

        $this->blockedIds = array_flip(array_filter(array_map(
            static fn(string $block) => ($item = $parser->parse($block)) !== null ? $item->getBlock()->getTypeId() : null,
            $config->get("blocks", [])
        )));
    }

    public function onProjectileHitBlock(ProjectileHitBlockEvent $event): void
    {
        $owner = $event->getEntity()->getOwningEntity();
        if (!$owner instanceof Player) return;
        if (!isset($this->blockedIds[$event->getBlockHit()->getTypeId()])) return;

        $owner->sendTip($this->message);
        $event->getEntity()->setOwningEntity(null);
    }
}