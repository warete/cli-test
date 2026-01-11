<?php

namespace Egor\Cli;

use Egor\Cli\Command\Command;
use Egor\Cli\Command\HelpCommand;
use Egor\Cli\Exception\CommandNotFound;
use Egor\Cli\IO\Contract\Input;
use Egor\Cli\IO\Contract\Output;

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
        $commandName = $this->input->getCommandName() ?? 'help';

        $command = $this->findCommand($commandName);

        if (!$command) {
            throw new CommandNotFound($commandName);
        }

        $command->handle($this->input, $this->output, $this);
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
