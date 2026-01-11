<?php

namespace Warete\Cli\Command\Contract;

use Warete\Cli\Application;
use Warete\Cli\IO\Contract\Input;
use Warete\Cli\IO\Contract\Output;

interface Command
{
    public function getName(): string;

    public function getDescription(): string;

    public function supports(string $commandName): bool;

    public function handle(Input $input, Output $output, Application $application): void;
}
