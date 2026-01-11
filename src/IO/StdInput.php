<?php

namespace Egor\Cli\IO;

use Egor\Cli\IO\Contract\Input;
use Egor\Cli\IO\Contract\InputParser;

class StdInput implements Input
{
    private array $params = [];
    private array $arguments = [];

    public function __construct(
        private readonly InputParser $paramsParser,
        private readonly InputParser $argumentsParser,
        private readonly array $argv = [],
    ) {
        $this->params = $this->paramsParser->setData($this->argv)->parse();
        $this->arguments = $this->argumentsParser->setData($this->argv)->parse();
    }

    public function getCommandName(): ?string
    {
        return \array_key_exists(1, $this->argv) ? $this->argv[1] : null;
    }

    public function getParams(): array
    {
        return $this->params;
    }

    public function getArguments(): array
    {
        return $this->arguments;
    }
}
