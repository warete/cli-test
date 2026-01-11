<?php

namespace Warete\Cli\Tests;

use PHPUnit\Framework\Attributes\AllowMockObjectsWithoutExpectations;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Warete\Cli\Application;
use Warete\Cli\Command\Contract\Command;
use Warete\Cli\Exception\CommandNotFound;
use Warete\Cli\IO\Contract\Input;
use Warete\Cli\IO\Contract\Output;

#[AllowMockObjectsWithoutExpectations]
class ApplicationTest extends TestCase
{
    private MockObject|Input $input;
    private MockObject|Output $output;

    protected function setUp(): void
    {
        $this->input = $this->createMock(Input::class);
        $this->output = $this->createMock(Output::class);
    }

    public function testGetCommandsReturnsAllCommands(): void
    {
        $command1 = $this->createMock(Command::class);
        $command2 = $this->createMock(Command::class);

        $app = new Application($this->input, $this->output);
        $app
            ->addCommand($command1)
            ->addCommand($command2);
        $commands = $app->getCommands();

        $this->assertContains($command1, $commands);
        $this->assertContains($command2, $commands);
    }

    public function testStartWithNotFoundError(): void
    {
        $this->input->method('getCommandName')->willReturn('foo');
        $this->input->method('getArguments')->willReturn([]);

        $app = new Application($this->input, $this->output);

        $this->expectException(CommandNotFound::class);
        $this->expectExceptionMessage('Command `foo` not found');

        $app->start();
    }

    public function testCommandExecutesSuccessfully(): void
    {
        $command = $this->createMock(Command::class);
        $command->method('supports')->willReturn(true);
        $command->expects($this->once())->method('handle');

        $this->input->method('getCommandName')->willReturn('foo');
        $this->input->method('getArguments')->willReturn([]);

        $app = new Application($this->input, $this->output);
        $app->addCommand($command);

        $app->start();
    }

    public function testShowHelpForCommand(): void
    {
        $command = $this->createMock(Command::class);
        $command->method('supports')->willReturn(true);
        $command->method('getDescription')->willReturn('Test description');
        $command->expects($this->once())->method('handle');

        $this->input->method('getCommandName')->willReturn('foo');
        $this->input->method('getArguments')->willReturn(['help']);
        $this->output->expects($this->once())->method('printLine')->with($this->stringContains('Test description'));

        $app = new Application($this->input, $this->output);
        $app->addCommand($command);

        $app->start();
    }
}
