<?php

namespace Warete\Cli\IO\Contract;

interface Output
{
    public function printLine(string $line = ''): static;
}
