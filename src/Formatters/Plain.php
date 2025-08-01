<?php

namespace Differ\Formatters\Plain;

function formatterPlain(array $tree, $depth = 1, $path = ''): string
{
    $startWord = "Property";

    $result = array_reduce($tree, function ($acc, $value) use ($startWord, $depth, $path) {
        $newPath = trim("{$path}.{$value['name']}", ".");
        switch ($value["type"]) {
            case 'nested':
                $acc[] = formatterPlain($value["children"], $depth + 1, $newPath);
                break;

            case 'unchanged':
                break;

            case 'changed':
                $value1 = formatValuePlain($value['value1']);
                $value2 = formatValuePlain($value['value2']);
                $acc[] = "$startWord '$newPath' was updated. From $value1 to $value2";
                break;

            case 'removed':
                $acc[] = "$startWord '$newPath' was removed";
                break;

            case 'added':
                $value2 = formatValuePlain($value['value2']);
                $acc[] = "$startWord '$newPath' was added with value: $value2";
                break;

            default:
                die("ERROR: Unknown diff between two values from files");
        }
        return $acc;
    }, []);

    $resultString = implode("\n", $result);
    return $depth === 1 ? "{$resultString}\n" : $resultString;
}

function formatValuePlain(mixed $value): string
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
