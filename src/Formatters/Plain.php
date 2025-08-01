<?php

namespace Differ\Formatters\Plain;

function formatterPlain(array $tree, int $depth = 1, string $path = ''): string
{
    $startWord = "Property";

    $lines = array_map(function ($value) use ($startWord, $depth, $path) {
        $newPath = trim("{$path}.{$value['name']}", ".");
        return match ($value["type"]) {
            'nested' => formatterPlain($value["children"], $depth + 1, $newPath),
            'unchanged' => null,
            'changed' => sprintf(
                "%s '%s' was updated. From %s to %s",
                $startWord,
                $newPath,
                formatValuePlain($value['value1']),
                formatValuePlain($value['value2'])
            ),
            'removed' => sprintf("%s '%s' was removed", $startWord, $newPath),
            'added' => sprintf(
                "%s '%s' was added with value: %s",
                $startWord,
                $newPath,
                formatValuePlain($value['value2'])
            ),
            default => die("ERROR: Unknown diff type '{$value['type']}'"),
        };
    }, $tree);

    $filteredLines = array_filter($lines, fn($line) => $line !== null);
    $resultString = implode("\n", $filteredLines);
    return $depth === 1 ? "{$resultString}\n" : $resultString;
}

function formatValuePlain(mixed $value): int|string
{
    if (is_array($value)) {
        return "[complex value]";
    }
    return match (true) {
        is_bool($value) => $value ? 'true' : 'false',
        is_null($value) => 'null',
        is_int($value) => $value,
        default => "'{$value}'",
    };
}
