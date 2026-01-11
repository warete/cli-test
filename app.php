<?php

require_once 'vendor/autoload.php';

$input = new \Egor\Cli\IO\StdInput(
    paramsParser: new \Egor\Cli\IO\ParamsParser(),
    argumentsParser: new \Egor\Cli\IO\ArgumentsParser(),
    argv: $argv,
);

$output = new \Egor\Cli\IO\StdOutput();

$app = new \Egor\Cli\Application(input: $input, output: $output);
$app->start();
