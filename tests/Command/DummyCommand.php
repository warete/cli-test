<?php

namespace Warete\Cli\Tests\Command;

use Warete\Cli\Application;
use Warete\Cli\Command\BaseCommand;
use Warete\Cli\IO\Contract\Input;
use Warete\Cli\IO\Contract\Output;

class DummyCommand extends BaseCommand
{
    public function handle(Input $input, Output $output, Application $application): void
    {

    }
}
