<?php
namespace Tests\unit;

use hphio\cli\BaseCli;

/**
 * {CLASS SUMMARY}
 *
 * Date: 9/17/18
 * Time: 10:13 PM
 *
 * @author Michael Munger <mj@hph.io>
 */
trait TreeTestingTraits
{
    public function getSampleTreeStructure(): array
    {
        $commands = ["user password reset", "user password invalidate", "user deactivate", "user activate", "show help", "show users", "foo bar", 'baz bar foo', 'baz barf zoo'];
        $treeStructure = [];
        foreach ($commands as $command) {
            $buffer = BaseCli::onionize(explode(" ", $command));
            $treeStructure = array_merge_recursive($treeStructure, $buffer);
        }
        return $treeStructure;
    }
}
