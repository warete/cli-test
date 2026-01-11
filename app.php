<?php

use Warete\CliApp\TestCommand;

require_once 'vendor/autoload.php';

$input = new \Warete\Cli\IO\StdInput(
    paramsParser: new \Warete\Cli\IO\ParamsParser(),
    argumentsParser: new \Warete\Cli\IO\ArgumentsParser(),
    argv: $argv,
);

$output = new \Warete\Cli\IO\StdOutput();

$app = new \Warete\Cli\Application(input: $input, output: $output);
$app->addCommand(new TestCommand());
$app->start();
