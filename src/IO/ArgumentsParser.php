<?php

namespace Egor\Cli\IO;

class ArgumentsParser implements Contract\InputParser
{
    /** @var array<int, string|null>  */
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
            $value = null;
            if (preg_match('/^{(.*)}$/', (string) $argValue, $matches)) {
                $value = $matches[1];
            }
            if (preg_match('/^[A-z]+$/', (string) $argValue)) {
                $value = $argValue;
            }
            if (!$value) {
                continue;
            }
            $valueParts = explode(',', $value);
            if (count($valueParts) > 1) {
                $result = [
                    ...$result,
                    ...$valueParts
                ];
            } else {
                $result[] = $value;
            }
        }

        return $result;
    }
}
