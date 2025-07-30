<?php

namespace Hexlet\Code\Gendiff;

use function Hexlet\Code\Parsers\Parser\parseFile;
use function Funct\Collection\sortBy;
use function Hexlet\Code\Differ\buildDiff;
use function Hexlet\Code\Formatters\Formatters\getFormatter;

function genDiff(string $pathToFile1, string $pathToFile2, string $formatter = 'stylish'): string
{
    $parsedData1 = parseFile($pathToFile1);
    $parsedData2 = parseFile($pathToFile2);

    $diff = buildDiff($parsedData1, $parsedData2);

    $functionFormatter = getFormatter($formatter);
    return $functionFormatter($diff);
}

// function getFormatter(string $formatter): callable
// {
//     return match ($formatter) {
//         'stylish' => 'Hexlet\Code\Formatters\Stylish\formatterStylish',
//         'plain' => 'Hexlet\Code\Formatters\Plain\formatterPlain',
//         default => die("ERROR: Unknown formatter: $formatter"),
//     };
// }
