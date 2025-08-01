<?php

namespace Differ\Formatters\Stylish;

function formatterStylish(array $tree, int $depth = 1): string
{
    $indent = str_repeat(' ', $depth * 4);
    $shortIndent = str_repeat(' ', $depth * 4 - 2);
    $closeIndent = str_repeat(' ', $depth * 4 - 4);

    $lines = array_map(function ($value) use ($depth, $indent, $shortIndent) {
        $name = $value['name'];

        return match ($value['type']) {
            'nested' => sprintf(
                "%s%s: %s",
                $indent,
                $name,
                formatterStylish($value["children"], $depth + 1)
            ),
            'unchanged' => sprintf(
                "%s%s: %s",
                $indent,
                $name,
                formatValueStylish($value['value'], $depth)
            ),
            'changed' => implode("\n", [
                sprintf(
                    "%s- %s: %s",
                    $shortIndent,
                    $name,
                    formatValueStylish($value['value1'], $depth)
                ),
                sprintf(
                    "%s+ %s: %s",
                    $shortIndent,
                    $name,
                    formatValueStylish($value['value2'], $depth)
                ),
            ]),
            'removed' => sprintf(
                "%s- %s: %s",
                $shortIndent,
                $name,
                formatValueStylish($value['value1'], $depth)
            ),
            'added' => sprintf(
                "%s+ %s: %s",
                $shortIndent,
                $name,
                formatValueStylish($value['value2'], $depth)
            ),
            default => die("Unknown diff type: {$value['type']}"),
        };
    }, $tree);

    $result = implode("\n", $lines);
    $full = "{\n{$result}\n{$closeIndent}}";
    return $depth === 1 ? "{$full}\n" : $full;
}

function formatValueStylish(mixed $value, int $depth = 1): string
{
    if (is_array($value)) {
        $indent = str_repeat(' ', (($depth + 1) * 4));
        $shortIndent = str_repeat(' ', (($depth + 1) * 4) - 4);

        $lines = array_map(
            fn($key, $val) => $indent . "$key: " . formatValueStylish($val, $depth + 1),
            array_keys($value),
            $value
        );

        return "{\n" . implode("\n", $lines) . "\n" . $shortIndent . "}";
    }
    return match (true) {
        is_bool($value) => $value ? 'true' : 'false',
        is_null($value) => 'null',
        default => (string) $value,
    };
}
