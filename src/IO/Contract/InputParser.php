<?php

namespace Warete\Cli\IO\Contract;

interface InputParser
{
    /**
     * @param list<string|null> $data
     * @return $this
     */
    public function setData(array $data): static;

    /**
     * @return array<string|int, string|array<string>|null>
     */
    public function parse(): array;
}
