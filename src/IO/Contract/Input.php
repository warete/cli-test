<?php

namespace Egor\Cli\IO\Contract;

interface Input
{
    public function getCommandName(): ?string;

    /**
     * @return array<string, array|string|null>
     */
    public function getParams(): array;

    /**
     * @return array<int, string|null>
     */
    public function getArguments(): array;
}
