<?php

namespace Warete\Cli\Command;

use Warete\Cli\Command\Contract\Command;

abstract class BaseCommand implements Command
{
    public function getName(): string
    {
        return (string) mb_strtolower(mb_strstr(new \ReflectionClass($this)->getShortName(), 'Command', true));
    }

    public function getDescription(): string
    {
        return '';
    }

    public function supports(string $commandName): bool
    {
        return $commandName === $this->getName();
    }
}
