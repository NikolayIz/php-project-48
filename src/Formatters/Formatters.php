<?php

namespace Differ\Formatters\Formatters;

function getFormatter(string $formatter): string
{
    return match ($formatter) {
        'stylish' => 'Differ\Formatters\Stylish\formatterStylish',
        'plain' => 'Differ\Formatters\Plain\formatterPlain',
        'json' => 'Differ\Formatters\Json\formatterJson',
        default => die("ERROR: Unknown formatter: $formatter"),
    };
}
