<?php

namespace Warete\Cli\IO;

class ArgumentsParser implements Contract\InputParser
{
    /** @var array<int, string|null> */
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
        /** @var array<int, string> $result */
        $result = [];
        foreach (\array_slice($this->data, 2) as $argValue) {
            $value = null;
            if (preg_match('/^{([A-z0-9,]+)}$/', (string) $argValue, $matches)) {
                $value = $matches[1];
            }
            if (preg_match('/^[A-z]+$/', (string) $argValue)) {
                $value = $argValue;
            }
            if (!mb_strlen((string) $value)) {
                continue;
            }
            $valueParts = explode(',', (string) $value);
            if (\count($valueParts) > 1) {
                $result = [
                    ...$result,
                    ...array_filter($valueParts, fn (string $part): bool => mb_strlen($part) > 0),
                ];
            } else {
                $result[] = (string) $value;
            }
        }

        return $result;
    }
}
