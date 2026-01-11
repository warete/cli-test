<?php

namespace Warete\CliApp;

use Warete\Cli\Application;
use Warete\Cli\Command\BaseCommand;
use Warete\Cli\IO\Contract\Input;
use Warete\Cli\IO\Contract\Output;

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

        $arguments = $input->getArguments();
        if ($arguments) {
            $output->printLine('Arguments:');
            foreach ($arguments as $arg) {
                $output->printLine(\sprintf("\t- %s", $arg));
            }
            $output->printLine();
        }

        $params = $input->getParams();
        if ($params) {
            $output->printLine('Options:');
            foreach ($params as $name => $value) {
                $output->printLine(\sprintf("\t- %s", $name));
                foreach (\is_array($value) ? $value : [$value] as $v) {
                    $output->printLine(\sprintf("\t\t- %s", $v));
                }
            }
        }
    }
}
