<?php

namespace Hexlet\Code\Formatters\Plain;

function formatterPlain(array $tree, $depth = 1, $path = ''): string
{
    $result = [];
    $startWord = "Property";
    foreach ($tree as $key => $value) {
        $newPath = trim($path . "." . $key, ".");
        switch ($value["type"]) {
            case 'nested':
                $line = formatterPlain($value["children"], $depth + 1, $newPath);
                $result[] = $line;
                break;

            case 'unchanged':
                break;

            case 'changed':
                $value1 = formatValuePlain($value['value1']);
                $value2 = formatValuePlain($value['value2']);
                $result[] = "$startWord '$newPath' was updated. From $value1 to $value2";
                break;

            case 'removed':
                $result[] = "$startWord '$newPath' was removed";
                break;

            case 'added':
                $value2 = formatValuePlain($value['value2']);
                $result[] = "$startWord '$newPath' was added with value: $value2";
                break;

            default:
                die("ERROR: Unknown diff between two values from files");
        }
    }

    $resultString = implode("\n", $result);
    return $depth === 1 ? $resultString . "\n" : $resultString;
}

function formatValuePlain(mixed $value): string
{
    if (is_array($value)) {
        return "[complex value]";
    }
    return match (true) {
        is_bool($value) => $value ? 'true' : 'false',
        is_null($value) => 'null',
        default => "'" . (string) $value . "'",
    };
}
