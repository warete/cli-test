<?php

namespace Egor\CliApp;

use Egor\Cli\Application;
use Egor\Cli\Command\BaseCommand;
use Egor\Cli\IO\Contract\Input;
use Egor\Cli\IO\Contract\Output;

class TestCommand extends BaseCommand
{
    public function getName(): string
    {
        return 'test';
    }

    public function getDescription(): string
    {
        return 'Print command info with called arguments and params';
    }

    public function handle(Input $input, Output $output, Application $application): void
    {
        $output->printLine(\sprintf('Called command: %s', $this->getName()));
        $output->printLine();

        $output->printLine('Arguments:');
        foreach ($input->getArguments() as $arg) {
            $output->printLine(\sprintf("\t- %s", $arg));
        }
        $output->printLine();

        $output->printLine('Options:');
        foreach ($input->getParams() as $name => $value) {
            $output->printLine(\sprintf("\t- %s", $name));
            foreach (is_array($value) ? $value : [$value] as $v) {
                $output->printLine(\sprintf("\t\t- %s", $v));
            }
        }
    }
}