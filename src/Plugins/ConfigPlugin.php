<?php
/**
 *
 */

namespace Mvc5\Test\Plugins;

use Mvc5\Plugins\Config;
use Mvc5\Plugins\Service;

class ConfigPlugin
{
    /**
     *
     */
    use Config {
        config as public;
    }
    use Service;
}
