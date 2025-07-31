<?php

namespace Hexlet\Code\Formatters\Stylish;

function formatterStylish(array $tree, $depth = 1): string
{
    $resultArr = [];
    $indent = str_repeat(' ', $depth * 4);
    $shortIndent = str_repeat(' ', $depth * 4 - 2);
    $closeIndent = str_repeat(' ', $depth * 4 - 4);

    $resultArr = array_reduce($tree, function ($acc, $value) use ($depth, $indent, $shortIndent) {
        switch ($value['type']) {
            case 'nested':
                $line = formatterStylish($value["children"], $depth + 1);
                $acc[] = "{$indent}{$value['name']}: {$line}";
                break;

            case 'unchanged':
                $formattedValue = formatValueStylish($value['value'], $depth);
                $acc[] = "{$indent}{$value['name']}: {$formattedValue}";
                break;

            case 'changed':
                $formattedValue1 = formatValueStylish($value['value1'], $depth);
                $formattedValue2 = formatValueStylish($value['value2'], $depth);
                $acc[] = "{$shortIndent}- {$value['name']}: {$formattedValue1}";
                $acc[] = "{$shortIndent}+ {$value['name']}: {$formattedValue2}";
                break;

            case 'removed':
                $formattedValue1 = formatValueStylish($value['value1'], $depth);
                $acc[] = "{$shortIndent}- {$value['name']}: {$formattedValue1}";
                break;

            case 'added':
                $formattedValue2 = formatValueStylish($value['value2'], $depth);
                $acc[] = "{$shortIndent}+ {$value['name']}: {$formattedValue2}";
                break;

            default:
                die("ERROR: Unknown diff between two values from files");
        }
        return $acc;
    }, []);

    $resultString = implode("\n", $resultArr);
    $resultFullString = "{\n{$resultString}\n{$closeIndent}}";
    return $depth === 1 ? "{$resultFullString}\n" : "{$resultFullString}";
}

function formatValueStylish(mixed $value, $depth = 1): string
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
