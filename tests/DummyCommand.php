<?php
/**
 * @namspace      Tests
 * @name DummyCommand
 * Summary: #$END$#
 *
 * Date: 2023-08-19
 * Time: 7:33 AM
 *
 * @author        Michael Munger <mj@hph.io>
 * @copyright (c) 2023 High Powered Help, Inc. All Rights Reserved.
 */

namespace Tests;

use hphio\cli\AbstractCommand;
use hphio\cli\AvailableCommands;
use hphio\cli\CommandInterface;
use League\Container\Container;

class DummyCommand extends AbstractCommand implements CommandInterface
{

    public function runCommand(Container $container, AvailableCommands $commands)
    {
        // TODO: Implement runCommand() method.
    }

    public function setAliases()
    {
        $this->setHelp();
        $this->setCommand();
    }

    public function setCommand(): void
    {
        $this->command = "dummy command";
    }

    public function setHelp(): void
    {
        $this->commandHelp = "This is a dummy command";
    }
}
