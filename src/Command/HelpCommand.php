<?php

namespace Warete\Cli\Command;

use Warete\Cli\Application;
use Warete\Cli\IO\Contract\Input;
use Warete\Cli\IO\Contract\Output;

class HelpCommand extends BaseCommand
{
    public function getName(): string
    {
        return 'help';
    }

    public function getDescription(): string
    {
        return 'Print list of commands';
    }

    public function handle(Input $input, Output $output, Application $application): void
    {
        $output->printLine('Available commands:');
        foreach ($application->getCommands() as $command) {
            $output->printLine(\sprintf('Name: %s', $command->getName()));
            if ($command->getDescription() !== '') {
                $output->printLine(\sprintf("\t%s%s", $command->getDescription(), PHP_EOL));
            }
        }
    }
}
