<?php

namespace Egor\Cli\IO;

class StdOutput implements Contract\Output
{
    public function printLine(string $line = ''): static
    {
        fwrite(STDOUT, $line . PHP_EOL);

        return $this;
    }
}
