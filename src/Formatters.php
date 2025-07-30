<?php

namespace Hexlet\Code\Formatters\Formatters;

function getFormatter(string $formatter): callable
{
    return match ($formatter) {
        'stylish' => 'Hexlet\Code\Formatters\Stylish\formatterStylish',
        'plain' => 'Hexlet\Code\Formatters\Plain\formatterPlain',
        default => die("ERROR: Unknown formatter: $formatter"),
    };
}
