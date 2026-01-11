<?php

namespace Warete\Cli\Tests\IO;

use PHPUnit\Framework\Attributes\AllowMockObjectsWithoutExpectations;
use PHPUnit\Framework\Attributes\TestWith;
use PHPUnit\Framework\TestCase;
use Warete\Cli\IO\ArgumentsParser;

#[AllowMockObjectsWithoutExpectations]
class ArgumentParserTest extends TestCase
{
    private ArgumentsParser $parser;

    protected function setUp(): void
    {
        $this->parser = new ArgumentsParser();
    }

    #[TestWith([['{foo}'], ['foo']])]
    #[TestWith([['foo'], ['foo']])]
    #[TestWith([[''], []])]
    #[TestWith([['[foo=bar]'], []])]
    #[TestWith([['{'], []])]
    #[TestWith([['{}'], []])]
    #[TestWith([['{ }'], []])]
    public function testParseSingleArgument(
        array $input,
        array $expected,
    ): void {
        $result = $this->parser->setData(['app.php', 'command', ...$input])->parse();

        $this->assertSame($expected, $result);
    }

    #[TestWith([['{foo,bar}'], ['foo', 'bar']])]
    #[TestWith([['foo', 'bar'], ['foo', 'bar']])]
    #[TestWith([['{foo,bar}', '{test}'], ['foo', 'bar', 'test']])]
    #[TestWith([['{foo,bar}', 'test'], ['foo', 'bar', 'test']])]
    #[TestWith([['{foo,}'], ['foo']])]
    public function testParseMultipleArguments(
        array $input,
        array $expected,
    ): void {
        $result = $this->parser->setData(['app.php', 'command', ...$input])->parse();

        $this->assertSame($expected, $result);
    }
}
