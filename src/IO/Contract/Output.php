<?php

namespace Egor\Cli\IO\Contract;

interface Output
{
    public function printLine(string $line = ''): static;
}
