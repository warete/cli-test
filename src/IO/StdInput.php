<?php

namespace Warete\Cli\IO;

use Warete\Cli\IO\Contract\Input;
use Warete\Cli\IO\Contract\InputParser;

class StdInput implements Input
{
    /**
     * @var array<string|int, string|array<string>|null>
     */
    private array $params;

    /**
     * @var array<string|int, string|array<string>|null>
     */
    private array $arguments;

    /**
     * @param InputParser $paramsParser
     * @param InputParser $argumentsParser
     * @param list<string|null> $argv
     */
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

    /**
     * @return array<string|int, string|array<string>|null>
     */
    public function getParams(): array
    {
        return $this->params;
    }

    /**
     * @return array<string|int, string|array<string>|null>
     */
    public function getArguments(): array
    {
        return $this->arguments;
    }
}
