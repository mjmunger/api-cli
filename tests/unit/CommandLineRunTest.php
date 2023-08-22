<?php
/**
 * Tests automatic runs of commands using the "-x" arg.
 *
 * Date: 10/21/18
 * Time: 1:18 PM
 *
 * @author Michael Munger <mj@hph.io>
 */

namespace Tests\unit;


use hphio\cli\AvailableCommands;
use hphio\cli\NoOp;
use hphio\cli\ShowHelp;
use Tests\unit\hphio\testing\TestCli;
use League\CLImate\CLImate;
use League\Container\Container;
use PDO;
use PHPUnit\Framework\TestCase;

class CommandLineRunTest extends TestCase
{
    private function getContainer(): Container
    {
        $pdo = $this->createMock(PDO::class);

        $container = new Container();
        $container->add(CLImate::class);
        $container->add('testmode', "foo");
        $container->add('db', $pdo);
        $container->add(NoOp::class)->addArgument($container);
        $container->add(TestCli::class)->addArgument($container);
        $container->add(AvailableCommands::class);
        $container->add(ShowHelp::class)->addArgument($container);
        return $container;

    }

    /**
     * @param $args
     * @param $expectedOutput
     *
     * @dataProvider providerArgs
     */
    public function testCliExecute($args, $expectedOutput)
    {
        $container = $this->getContainer();

        $container->add('argv', $args);

        $this->expectOutputString($expectedOutput);
        $cli = $container->get(TestCli::class);
        $this->assertInstanceOf(TestCli::class, $cli);
    }

    public static function providerArgs(): array
    {
        return [
            CommandLineRunTest::runNoOp(),
            CommandLineRunTest::missingArg(),
            CommandLineRunTest::emptyArg(),
            CommandLineRunTest::nonExistentCommand(),
        ];
    }

    public static function runNoOp(): array
    {
        return [['cli.php', '-x', 'noop'], "NoOp command runs!" . PHP_EOL];
    }

    public static function missingArg(): array
    {
        return [['cli.php', '-x'], "-x requires an additional argument, which is the command you want to run. Run 'show help' for more information." . PHP_EOL];
    }

    public static function emptyArg(): array
    {
        return [['cli.php', '-x', ''], "-x requires an additional argument, which is the command you want to run. Run 'show help' for more information." . PHP_EOL];
    }

    public static function nonExistentCommand(): array
    {
        return [['cli.php', '-x', 'nonexistent'], "Command 'nonexistent' could not be found or run. Check your syntax and make sure it really exists. Run 'show help' for more information." . PHP_EOL];
    }


}
