<?php
namespace Tests\unit;
use hphio\cli\AbstractCommand;
use hphio\cli\AvailableCommands;
use hphio\cli\ShowHelp;
use League\CLImate\CLImate;
use League\Container\Container;
/**
 * Trait that creates a standard testing container for the CLI
 *
 * Date: 9/17/18
 * Time: 8:56 PM
 * @author Michael Munger <mj@hph.io>
 */

trait StandardTestContainerTrait {
    public function getStandardTestContainer(): Container
    {
        $container = new Container();
        $mockPDO = $this->getMockBuilder(\PDO::class)
            ->disableOriginalConstructor()
            ->getMock();

        $container->add(CLImate::class);

        $container->add('db',$mockPDO);

        $commandStub1 = $this->createMock(AbstractCommand::class);
        $commandStub1->method('getCommand')->willReturn("Command 1");
        $commandStub1->method('getHelp')->willReturn("Help for command 1");

        $commandStub2 = $this->createMock(AbstractCommand::class);
        $commandStub2->method('getCommand')->willReturn("Command 2");
        $commandStub2->method('getHelp')->willReturn("Help for command 2");

        $container->add(AvailableCommands::class);
//        $container->add(SeedUUIDs::class, $commandStub1);
        $container->add(ShowHelp::class , $commandStub2);

        return $container;
    }
}
