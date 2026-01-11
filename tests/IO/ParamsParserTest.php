<?php

namespace Warete\Cli\Tests\IO;

use PHPUnit\Framework\Attributes\AllowMockObjectsWithoutExpectations;
use PHPUnit\Framework\Attributes\TestWith;
use PHPUnit\Framework\TestCase;
use Warete\Cli\IO\ParamsParser;

#[AllowMockObjectsWithoutExpectations]
class ParamsParserTest extends TestCase
{
    private ParamsParser $parser;

    protected function setUp(): void
    {
        $this->parser = new ParamsParser();
    }

    #[TestWith([['[foo=bar]'], ['foo' => ['bar']]])]
    #[TestWith([['[foo=]'], ['foo' => ['']]])]
    #[TestWith([[''], []])]
    #[TestWith([['{foo}'], []])]
    #[TestWith([['{foo=bar}'], []])]
    #[TestWith([['['], []])]
    #[TestWith([['[]'], []])]
    #[TestWith([['[ ]'], []])]
    public function testParseSingleParam(
        array $input,
        array $expected,
    ): void {
        $result = $this->parser->setData(['app.php', 'command', ...$input])->parse();

        $this->assertSame($expected, $result);
    }

    #[TestWith([['[foo={bar1,bar2}]'], ['foo' => ['bar1', 'bar2']]])]
    #[TestWith([['[foo=bar1]', '[foo=bar2]'], ['foo' => ['bar1', 'bar2']]])]
    #[TestWith([['[foo=bar1,]'], ['foo' => ['bar1']]])]
    public function testParseMultipleParams(
        array $input,
        array $expected,
    ): void {
        $result = $this->parser->setData(['app.php', 'command', ...$input])->parse();

        $this->assertSame($expected, $result);
    }
}
