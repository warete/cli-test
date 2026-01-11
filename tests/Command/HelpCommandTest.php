<?php

namespace Warete\Cli\Tests\Command;

use PHPUnit\Framework\Attributes\AllowMockObjectsWithoutExpectations;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Warete\Cli\Application;
use Warete\Cli\Command\HelpCommand;
use Warete\Cli\IO\Contract\Input;
use Warete\Cli\IO\Contract\Output;

#[AllowMockObjectsWithoutExpectations]
class HelpCommandTest extends TestCase
{
    private MockObject|Input $input;
    private MockObject|Output $output;
    private MockObject|Application $app;

    protected function setUp(): void
    {
        $this->input = $this->createMock(Input::class);
        $this->output = $this->createMock(Output::class);
        $this->app = $this->createMock(Application::class);
    }

    public function testGetName(): void
    {
        $command = new HelpCommand();

        $this->assertEquals('help', $command->getName());
    }

    public function testGetDescription(): void
    {
        $command = new HelpCommand();

        $this->assertEquals('Print list of commands', $command->getDescription());
    }

    public function testHandlePrintsResult(): void
    {
        $this->app->method('getCommands')->willReturn([
            new HelpCommand(),
        ]);
        $this->output->expects($this->atLeastOnce())->method('printLine');

        $command = new HelpCommand();
        $command->handle($this->input, $this->output, $this->app);
    }
}
