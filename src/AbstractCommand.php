<?php
/**
 * Abstract Command, which forms the basis for all CLI comands.
 *
 * Date: 9/17/18
 * Time: 4:33 PM
 * @author Michael Munger <mj@hph.io>
 * @copyright (c) 2017-2018 High Powered Help, Inc. All rights reserved.
 */

namespace hphio\cli;
use \League\Container\Container;

include('CommandInterface.php');

abstract class AbstractCommand implements CommandInterface
{
    protected $command = "foo";
    protected $commandHelp = "bar baz";
    protected $command_aliases = [];


    public function getCommand()
    {
        return $this->command;
    }

    public function getHelp() {
        return $this->commandHelp;
    }

    public function is($command) {
        return ($command == $this->command);
    }

    public function addAlias($alias) {
        $this->command_aliases[] = $alias;
    }

    public function hasAlias($needle) {
        return in_array($needle, $this->command_aliases);
    }

    public function getAliases() {
        return $this->command_aliases;
    }


}
