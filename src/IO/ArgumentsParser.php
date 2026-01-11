<?php

namespace Egor\Cli\IO;

class ArgumentsParser implements Contract\InputParser
{
    private array $data = [];

    public function setData(array $data): static
    {
        $this->data = $data;

        return $this;
    }

    /**
     * @return array<int, string>
     */
    public function parse(): array
    {
        $result = [];
        foreach (\array_slice($this->data, 2) as $argValue) {
            if (preg_match('/^{(.*)}$/', $argValue, $matches)) {
                $result[] = $matches[1];
            }
            if (preg_match('/^[A-z]+$/', $argValue)) {
                $result[] = $argValue;
            }
        }

        return $result;
    }
}
