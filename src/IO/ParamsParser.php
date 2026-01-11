<?php

namespace Egor\Cli\IO;

class ParamsParser implements Contract\InputParser
{
    /** @var array<int, string|null> */
    private array $data = [];

    /**
     * @param array<int, string|null> $data
     * @return $this
     */
    public function setData(array $data): static
    {
        $this->data = $data;

        return $this;
    }

    /**
     * @return array<string, array<string>|string|null>
     */
    public function parse(): array
    {
        $result = [];
        foreach (\array_slice($this->data, 2) as $argValue) {
            if (preg_match('/^\[(?<name>.+?)=(?<value>.*?)\]$/', (string) $argValue, $matches)) {
                $result[$matches['name']] ??= [];
                $valueParts = explode(',', $matches['value']);
                if (count($valueParts) > 1) {
                    $result[$matches['name']] = [
                        ...$result[$matches['name']],
                        ...$valueParts
                    ];
                } else {
                    $result[$matches['name']][] = $matches['value'];
                }
            }
        }

        return $result;
    }
}
