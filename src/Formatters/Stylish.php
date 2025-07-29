<?php

namespace Hexlet\Code\Formatters\Stylish;

function formatterStylish(array $tree, $depth = 1): string
{
    $result = [];
    $indent = str_repeat(' ', $depth * 4);
    $shortIndent = str_repeat(' ', $depth * 4 - 2);
    $closeIndent = str_repeat(' ', $depth * 4 - 4);

    foreach ($tree as $key => $value) {
        switch ($value['type']) {
            case 'nested':
                $line = formatterStylish($value["children"], $depth + 1);
                $result[] = "$indent" . "$key: " . "$line";
                break;

            case 'unchanged':
                $formattedValue = formatValue($value['value'], $depth);
                $result[] = "$indent" . "$key: " . "$formattedValue";
                break;

            case 'changed':
                $formattedValue1 = formatValue($value['value1'], $depth);
                $formattedValue2 = formatValue($value['value2'], $depth);
                $result[] = "$shortIndent" . "- $key: " . "$formattedValue1";
                $result[] = "$shortIndent" . "+ $key: " . "$formattedValue2";
                break;

            case 'removed':
                $formattedValue1 = formatValue($value['value1'], $depth);
                $result[] = "$shortIndent" . "- $key: " . "$formattedValue1";
                break;

            case 'added':
                $formattedValue2 = formatValue($value['value2'], $depth);
                $result[] = "$shortIndent" . "+ $key: " . "$formattedValue2";
                break;
            default:
                throw new \Exception("Unknown diff between two values from files");
        }
    }
    $resultString = "{\n" . implode("\n", $result) . "\n" . $closeIndent . "}";
    return $depth === 1 ? $resultString . "\n" : $resultString;
}

function formatValue(mixed $value, $depth = 1): string
{
    if (is_array($value)) {
        $indent = str_repeat(' ', (($depth + 1) * 4));
        $shortIndent = str_repeat(' ', (($depth + 1) * 4) - 4);

        $lines = array_map(
            fn($key, $val) => $indent . "$key: " . formatValue($val, $depth + 1),
            array_keys($value),
            $value
        );

        return "{\n" . implode("\n", $lines) . "\n" . $shortIndent . "}";
    };
    return match (true) {
        is_bool($value) => $value ? 'true' : 'false',
        is_null($value) => 'null',
        default => (string) $value,
    };
}
