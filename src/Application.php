<?php

namespace Egor\Cli;

use Egor\Cli\Command\Contract\Command;
use Egor\Cli\Command\HelpCommand;
use Egor\Cli\Exception\CommandNotFound;
use Egor\Cli\IO\Contract\Input;
use Egor\Cli\IO\Contract\Output;
use Throwable;

class Application
{
    /** @var non-empty-list<Command> */
    private array $commands = [];

    public function __construct(
        private Input $input,
        private Output $output,
    ) {
        $this->commands = [
            new HelpCommand(),
        ];
    }

    public function start(): void
    {
        try {
            $commandName = $this->input->getCommandName() ?? 'help';

            $command = $this->findCommand($commandName);

            if (!$command) {
                throw new CommandNotFound($commandName);
            }

            if (\in_array('help', $this->input->getArguments())) {
                $this->output->printLine(\sprintf('Command help: %s%s', $command->getDescription(), PHP_EOL));
            }

            $command->handle($this->input, $this->output, $this);
        } catch (Throwable $e) {
            $this->output->printLine(\sprintf("An error occurred: `%s`%sStack:%s", $e->getMessage(), PHP_EOL, $e->getTraceAsString()));
        }
    }

    /**
     * @return Command[]
     */
    public function getCommands(): array
    {
        return $this->commands;
    }

    public function addCommand(Command $command): static
    {
        $this->commands[] = $command;

        return $this;
    }

    private function findCommand(string $commandName): ?Command
    {
        foreach ($this->commands as $command) {
            if ($command->supports($commandName)) {
                return $command;
            }
        }

        return null;
    }
}
