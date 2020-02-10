<?php

namespace App\Utilities;

use Composer\Script\Event;

class ComposerScripts
{
    /**
     * Run scripts that follow only if dev packages are installed.
     *
     * @param Event $event
     */
    public static function developmentMode(Event $event)
    {
        if (!$event->isDevMode()) {
            $event->stopPropagation();
            echo "Skipping {$event->getName()} as this is a non-dev installation.\n";
        }
    }
}
