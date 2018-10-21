<?php
/**
 * {CLASS SUMMARY}
 *
 * Date: 10/21/18
 * Time: 1:26 PM
 * @author Michael Munger <mj@hph.io>
 */

namespace hphio\cli;


use League\Container\Container;

class NoOp extends AbstractCommand
{

    protected $command = "noop";
    protected $commandHelp = "NoOp command echos back your arguments for testing.";

    public function runCommand(Container $container, AvailableCommands $commands)
    {
        echo "NoOp command runs!" . PHP_EOL;
    }
}