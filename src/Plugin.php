<?php

namespace Digitlimit\HelperOverride;

use Composer\Composer;
use Composer\IO\IOInterface;
use Composer\Plugin\PluginInterface;
use Composer\Script\Event;
use Composer\Script\ScriptEvents;

class Plugin implements PluginInterface
{
    public function activate(Composer $composer, IOInterface $io)
    {
        $composer->getEventDispatcher()->addListener(ScriptEvents::PRE_AUTOLOAD_DUMP, [$this, 'onPreAutoloadDump']);
    }

    public function deactivate(Composer $composer, IOInterface $io)
    {
        // No action required on deactivate
    }

    public function uninstall(Composer $composer, IOInterface $io)
    {
        // No action required on uninstall
    }

    public function onPreAutoloadDump(Event $event)
    {
        $vendorDir = $event->getComposer()->getConfig()->get('vendor-dir');
        $autoloadFile = $vendorDir . '/autoload.php';
        $customHelpersFile = __DIR__ . '/Helpers/helpers.php';

        // Prepend custom helpers file to the autoloader
        if (file_exists($autoloadFile)) {
            $autoloadContent = file_get_contents($autoloadFile);
            $autoloadContent = str_replace("<?php", "<?php\nrequire_once '$customHelpersFile';", $autoloadContent);
            file_put_contents($autoloadFile, $autoloadContent);
        }
    }
}
