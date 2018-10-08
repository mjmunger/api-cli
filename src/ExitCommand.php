<?php
/**
 * Displays all commands and their descriptions
 *
 * Date: 9/17/18
 * Time: 4:39 PM
 * @author Michael Munger <mj@hph.io>
 * @copyright (c) 2017-2018 High Powered Help, Inc. All rights reserved.
 */

namespace hphio\cli;
use \League\Container\Container;

class ExitCommand extends AbstractCommand
{
    protected $command = "exit";
    protected $commandHelp = "Exits the CLI";

    public function __construct($db)
    {
        $this->db = $db;
        $this->addAlias('quit');
    }

    public function showGoodbye() {
        echo "CLI shutting down.";
        echo PHP_EOL;
    }

    public function runCommand(Container $container, AvailableCommands $commands)
    {
        $this->showGoodbye();
        exit;
    }
}
