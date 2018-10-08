<?php
/**
 * Configures logging for various components in a given system.
 *
 * Date: 10/5/18
 * Time: 11:01 AM
 * @author Michael Munger <mj@hph.io>
 */

namespace hphio\cli;


use League\Container\Container;
use PHPUnit\Framework\TestCase;

class LoggingConfiguratorTest extends TestCase
{
    private $container = null;

    public function testAvailableCommands() {

        $commands = new AvailableCommands();
    }
}