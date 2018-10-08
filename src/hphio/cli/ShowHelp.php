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

class ShowHelp extends AbstractCommand
{
    protected $command = "show help";
    protected $commandHelp = "Shows all available commands";

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function runCommand(Container $container, AvailableCommands $commands)
    {
        foreach($commands as $command) {
            $buffer[$command->getCommand()] = $command->getHelp();

            foreach($command->getAliases() as $alias) {
                $buffer[$alias] = $command->getHelp() . " (alias of " . $command->getCommand() . ")";
            }
        }

        ksort($buffer);

        $maxC1 = 0;
        $maxC2 = 0;

        foreach($buffer as $command => $help) {
            if(strlen($command) > $maxC1) $maxC1 = strlen($command);
            if(strlen($help)    > $maxC2) $maxC2 = strlen($help);
        }

        //Add gutter
        $maxC1 = $maxC1 + 2;

        printf("Available commands:\n");
        echo PHP_EOL;
        printf(str_pad("COMMAND", $maxC1));
        printf(str_pad("DESCRIPTION", $maxC2));
        echo PHP_EOL;
        printf(str_pad("",$maxC1 + $maxC2 + 2, "="));
        echo PHP_EOL;

        foreach($buffer as $command => $help) {
            printf(str_pad($command, $maxC1));
            printf(str_pad($help   , $maxC2));
            echo PHP_EOL;
        }
        echo PHP_EOL;
    }
}
