<?php
/**
 * Abstract class that forms the base of all CLI's.
 *
 * Date: 9/17/18
 * Time: 4:35 PM
 * @author Michael Munger <mj@hph.io>
 * @copyright (c) 2017-2018 High Powered Help, Inc. All rights reserved.
 */

namespace hphio\cli;

include('CliInterface.php');

abstract class BaseCli implements CliInterface
{
    protected $container = null;

    public $grammar   = [];
    public $commands  = [];

    public function __construct($container)
    {
        if($this->isCLI() === false) die("The CLI must only be run via the terminal. No Apache for you!!!\n");

        $this->container = $container;
        $this->commands = $container->get(AvailableCommands::class);
        $this->loadCommands();
        $this->loadGrammar();
    }

    public function showBanner()
    {
        echo "HPHIO CLI starting up...\n\n";
    }

    public function getPrompt() {
        return "HPHIO*CLI> ";
    }

    public function showGoodbye() {
        echo "CLI shutting down.";
        echo PHP_EOL;
    }

    public function isCLI() {
        return (php_sapi_name() === 'cli');
    }

    public function loadCommands() {

        //Load available commands
        $this->commands->add($this->container->get(ShowHelp::class));

    }

    protected function loadGrammar() {
        $grammar = [];

        foreach($this->commands as $command) {
            $command = $command->getCommand();
            $thisGrammar = $this->onionize(explode(" ", $command));
            $grammar = array_merge_recursive($grammar,$thisGrammar);
        }

        $this->grammar = $grammar;
    }

    public static function onionize($buffer) {

        //pop off the last one to make the seed array.
        $value = null;
        $key = array_pop($buffer);

        $seed = [$key => $value];


        //Wrap the rest outward.

        for($x = count($buffer) -1; $x >= 0; $x--) {
            $key = array_pop($buffer);
            $tmp = [$key => $seed];
            $seed = $tmp;
        }

        return $seed;
    }

    public function run() {
        $this->showBanner();

        $line = '';

        readline_completion_function([$this,"traverse_tree"]);

        while($line !== "quit" && $line !== 'exit') {
            $line = readline($this->getPrompt());
            $line = strtolower(trim($line));
            $commandsRun = 0;

            foreach($this->commands as $Command) {
                if($Command->is($line) || $Command->hasAlias($line)){
                    $commandsRun++;
                    $Command->runCommand($this->container, $this->commands);
                }
            }

            if($commandsRun === 0) echo "Command not recognized.\n";
        }

        echo "\n";
        echo "CLI shutting down...Good bye!\n";
        exit;
    }

    function traverse_tree($input, $index, $tree)
    {
        //Initialize return values
        $return_values = [];
        $tree = $this->grammar;

        //Pull from readline library.
        $rl_info = readline_info();

        //Get everything I typed.
        $readline_input = substr($rl_info['line_buffer'], 0, $rl_info['end']);

        $Tree = new Tree();
        $Tree->setTree($this->grammar);
        return $Tree->getChoices($readline_input);
    }
}