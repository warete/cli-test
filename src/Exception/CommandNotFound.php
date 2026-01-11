<?php

namespace Warete\Cli\Exception;

use Throwable;

class CommandNotFound extends \RuntimeException
{
    public function __construct(string $command, ?Throwable $previous = null)
    {
        parent::__construct(\sprintf('Command `%s` not found', $command), 0, $previous);
    }
}
