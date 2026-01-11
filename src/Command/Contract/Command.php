<?php

namespace Egor\Cli\Command\Contract;

use Egor\Cli\Application;
use Egor\Cli\IO\Contract\Input;
use Egor\Cli\IO\Contract\Output;

interface Command
{
    public function getName(): string;

    public function getDescription(): string;

    public function supports(string $commandName): bool;

    public function handle(Input $input, Output $output, Application $application): void;
}
