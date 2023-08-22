<?php
/**
 * @namspace      Tests
 * @name DummyCLI
 * Summary: #$END$#
 *
 * Date: 2023-08-19
 * Time: 7:46 AM
 *
 * @author        Michael Munger <mj@hph.io>
 * @copyright (c) 2023 High Powered Help, Inc. All Rights Reserved.
 */

namespace Tests;

use hphio\cli\BaseCli;
use hphio\cli\ShowHelp;

class DummyCLI extends BaseCli
{
    public function loadCommands(): void
    {

        //Load available commands
        $this->commands->add($this->container->get(ShowHelp::class));
        $this->commands->add($this->container->get(DummyCommand::class));
    }
}
