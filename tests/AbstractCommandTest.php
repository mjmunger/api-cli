<?php
/**
 * @namspace      Tests
 * @name AbstractCommandTest
 * Summary: #$END$#
 *
 * Date: 2023-08-19
 * Time: 7:32 AM
 *
 * @author        Michael Munger <mj@hph.io>
 * @copyright (c) 2023 High Powered Help, Inc. All Rights Reserved.
 */

namespace Tests;

use hphio\cli\AbstractCommand;
use hphio\cli\BaseCli;
use PHPUnit\Framework\TestCase;
use Tests\unit\StandardTestContainerTrait;

class AbstractCommandTest extends TestCase
{
    use StandardTestContainerTrait;

    public function providerTestRunExceptions(): array
    {
        return [
            $this->unknownException(),
//            AbstractCommandTest::knownException(),
        ];
    }

    public function testGetHelp()
    {
        $container = $this->getStandardTestContainer();
        $command = new DummyCommand($container);
        $help = "This is a test help string.";

        $reflectionClass = new \ReflectionClass($command);
        $reflectionProperty = $reflectionClass->getProperty('commandHelp');
        $reflectionProperty->setAccessible(true);
        $reflectionProperty->setValue($command, $help);

        $this->assertSame($help, $command->getHelp());
    }

    public function testAddAlias()
    {
        $container = $this->getStandardTestContainer();
        $command = new DummyCommand($container);
        $command->addAlias('foo alias');
        $this->assertTrue($command->hasAlias('foo alias'));

        $aliases = $command->getAliases();
        $this->assertSame(['foo alias'], $aliases);
    }

    /**
     * @return void
     * @dataProvider providerTestRunExceptions
     */
    public function testRunExceptions($container)
    {
        $this->markTestSkipped("This test doesn't work yet. Need to resolve some testing phpunit v10 issues.");
        $cli = new DummyCLI($container);
        $cli->run();
    }

    public function unknownException(): array
    {
        $container = $this->getStandardTestContainer();

        $mock = $this->getMockBuilder(DummyCommand::class)
            ->setConstructorArgs([$container])
            ->onlyMethods(['runCommand'])
            ->getMock();

        $mock->method('runCommand')
            ->willThrowException(new \Exception('This is a test exception'));

        $container->add(DummyCommand::class, $mock);

        $argv = ['testing', '-x', 'dummy command'];
        $container->add('argv', $argv);

        return [$container];
    }
}
