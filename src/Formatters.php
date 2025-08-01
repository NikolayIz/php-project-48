<?php

namespace Differ\Formatters\Formatters;

function getFormatter(string $formatter): string
{
    return match ($formatter) {
        'stylish' => 'Hexlet\Code\Formatters\Stylish\formatterStylish',
        'plain' => 'Hexlet\Code\Formatters\Plain\formatterPlain',
        'json' => 'Hexlet\Code\Formatters\Json\formatterJson',
        default => die("ERROR: Unknown formatter: $formatter"),
    };
}
