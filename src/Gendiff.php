<?php

namespace Hexlet\Code\Gendiff;

use function Hexlet\Code\Parsers\Parser\parseFile;
use function Funct\Collection\sortBy;

function genDiff(string $pathToFile1, string $pathToFile2): string
{
    $dataFromFile1 = file_get_contents(realpath($pathToFile1));
    $dataFromFile2 = file_get_contents(realpath($pathToFile2));
    $decoded1 = parseFile($dataFromFile1);
    $decoded2 = parseFile($dataFromFile2);

    $sortedDecoded1 = sortBy($decoded1, fn($value) => $value, 'ksort');
    $sortedDecoded2 = sortBy($decoded2, fn($value) => $value, 'ksort');
    $keys1 = array_keys($sortedDecoded1);
    $keys2 = array_keys($sortedDecoded2);
    $allKeys = array_merge($keys1, $keys2);
    $allUniqKeys = array_unique($allKeys);
    $sortedUniqKeys = sortBy($allUniqKeys, fn($value) => $value, 'asort');
    // sort($allUniqKeys); мутирующая функция

    $result = array_reduce(
        $sortedUniqKeys,
        function ($carry, $key) use ($sortedDecoded1, $sortedDecoded2) {
            $inFirst = array_key_exists($key, $sortedDecoded1);
            $inSecond = array_key_exists($key, $sortedDecoded2);

            $value1 = $sortedDecoded1[$key] ?? null;
            $value2 = $sortedDecoded2[$key] ?? null;

            $diffType = match (true) {
                $inFirst && $inSecond && ($value1 === $value2) => 'equal',
                $inFirst && $inSecond => 'modified',
                $inFirst => 'removed',
                $inSecond => 'added',
                default => 'none',
            };

            $line = match ($diffType) {
                'equal'     => "    $key: " . formatValue($value1) . "\n",
                'modified'  => "  - $key: " . formatValue($value1) . "\n"
                             . "  + $key: " . formatValue($value2) . "\n",
                'removed'   => "  - $key: " . formatValue($value1) . "\n",
                'added'     => "  + $key: " . formatValue($value2) . "\n",
                default     => '',
            };

            return $carry . $line;
        },
        ""
    );

    return "{\n" . $result . "}\n";
}

function formatValue($value): string
{
    if (is_bool($value)) {
        return $value ? 'true' : 'false';
    }

    if (is_null($value)) {
        return 'null';
    }

    return (string) $value;
}
