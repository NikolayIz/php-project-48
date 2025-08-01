<?php

namespace Differ\Differ;

use function Parsers\Parser\parseFile;
use function Funct\Collection\sortBy;
use function Formatters\Formatters\getFormatter;

function genDiff(string $pathToFile1, string $pathToFile2, string $formatter = 'stylish'): string
{
    $parsedData1 = parseFile($pathToFile1);
    $parsedData2 = parseFile($pathToFile2);

    $diff = buildDiff($parsedData1, $parsedData2);

    $functionFormatter = getFormatter($formatter);
    return $functionFormatter($diff);
}

function buildDiff(array $tree1, array $tree2): array
{
    $allKeys = array_unique(array_merge(array_keys($tree1), array_keys($tree2)));
    $allSortedKeys = sortBy($allKeys, fn($v) => $v);

    return array_reduce($allSortedKeys, function ($acc, $key) use ($tree1, $tree2) {
        $inFirst = array_key_exists($key, $tree1);
        $inSecond = array_key_exists($key, $tree2);

        $value1 = $tree1[$key] ?? null;
        $value2 = $tree2[$key] ?? null;

        $type = match (true) {
            isAssoc($value1) && isAssoc($value2) => 'nested',
            $inFirst && $inSecond && ($value1 === $value2) => 'unchanged',
            $inFirst && $inSecond => 'changed',
            $inFirst => 'removed',
            $inSecond => 'added',
            default => die("Unknown diff"),
        };

        $acc[$key] = match ($type) {
            'nested' => [
                'name' => $key,
                'type' => $type,
                'children' => buildDiff($value1, $value2)
            ],
            'unchanged' => [
                'name' => $key,
                'type' => $type,
                'value' => $value1
            ],
            'changed' => [
                'name' => $key,
                'type' => $type,
                'value1' => $value1,
                'value2' => $value2,
            ],
            'removed' => [
                'name' => $key,
                'type' => $type,
                'value1' => $value1
            ],
            'added' => [
                'name' => $key,
                'type' => $type,
                'value2' => $value2
            ],
        };

        return $acc;
    }, []);
}

function isAssoc(mixed $array): bool
{
    if (is_array($array)) {
        return array_keys($array) !== range(0, count($array) - 1);
    }
    return false;
}
