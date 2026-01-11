<?php

namespace Egor\Cli\IO\Contract;

interface InputParser
{
    /**
     * @param list<string> $data
     * @return $this
     */
    public function setData(array $data): static;

    /**
     * @return array<string|int, string|array|null>
     */
    public function parse(): array;
}
