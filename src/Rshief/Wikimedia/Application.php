<?php

namespace Rshief\Wikimedia;

use Rshief\Wikimedia\Command\ParseCommand;
use Symfony\Component\Console\Application as BaseApplication;

/**
 * Class Application
 * @package Rshief
 */
class Application extends BaseApplication
{
    protected function getDefaultCommands()
    {
        $defaultCommands = parent::getDefaultCommands();
        $defaultCommands[] = new ParseCommand();

        return $defaultCommands;
    }
}
