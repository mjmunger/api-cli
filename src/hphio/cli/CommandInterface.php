<?php
/**
 * Defines the command interface for API CLI commands.
 *
 * Date: 9/17/18
 * Time: 4:40 PM
 * @author Michael Munger <mj@hph.io>
 * @copyright (c) 2017-2018 High Powered Help, Inc. All rights reserved.
 */

namespace hphio\cli;
use \League\Container\Container;

interface CommandInterface
{
    public function runCommand(Container $container, AvailableCommands $commands);
    public function is($command);
}