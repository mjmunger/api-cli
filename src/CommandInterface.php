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
    public function setAliases();
    public function getCommand(): ?string;
    public function getHelp(): ?string;
    public function is($command): bool;
    public function addAlias($alias);
    public function hasAlias($needle): bool;
    public function getAliases(): ?array;

    /**
     * Sets the command used to invoke the command.
     * Example:
     * public function setCommand(): void
     * {
     *     $this->command = "show help";
     * }
     *
     * @param $command
     *
     * @return void
     */
    public function setCommand(): void;

    /**
     * Sets the help text for the command.
     * Example:
     * public function setHelp(): void
     * {
     *     $this->commandHelp = "Shows all available commands";
     * }
     * @param $help
     *
     * @return void
     */
    public function setHelp(): void;
}
