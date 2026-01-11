<?php

namespace Warete\Cli\IO\Contract;

interface Input
{
    public function getCommandName(): ?string;

    /**
     * @return array<string, array<string>|string|null>
     */
    public function getParams(): array;

    /**
     * @return array<int, string|null>
     */
    public function getArguments(): array;
}
