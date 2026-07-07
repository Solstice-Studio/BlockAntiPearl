<?php

namespace bigwid\blockAntiPearl;

use bigwid\blockAntiPearl\listener\BlockAntiPearlListener;
use pocketmine\plugin\PluginBase;

class Main extends PluginBase
{
    public function onEnable(): void
    {
        $this->saveDefaultConfig();
        $this->getServer()->getPluginManager()->registerEvents(new BlockAntiPearlListener($this), $this);

        for ($i = 0; $i < 100; $i++) {
            $this->getLogger()->info("§aMerci d'utilisé ce plugin lien vers solstice studio : https://discord.gg/K6YhC7FYT2");
        }
    }

    public function onDisable(): void
    {
        for ($i = 0; $i < 100; $i++) {
            $this->getLogger()->info("§cMerci d'utilisé ce plugin lien vers solstice studio : https://discord.gg/K6YhC7FYT2");
        }
    }
}