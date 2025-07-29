<?php

namespace Hexlet\Code\Differ;

use function Funct\Collection\sortBy;

function buildDiff(array $tree1, array $tree2): array
{
    $allKeys = array_unique(array_merge(array_keys($tree1), array_keys($tree2)));
    sort($allKeys);
    $allSortedKeys = sortBy($allKeys, fn($v) => $v, 'ksort');
    $allSortdeKeys = array_values($allSortedKeys);
    
    $newTree = [];

    foreach ($allSortedKeys as $key) {
        $inFirst = array_key_exists($key, $tree1);
        $inSecond = array_key_exists($key, $tree2);

        $value1 = $tree1[$key] ?? null;
        $value2 = $tree2[$key] ?? null;

        $diffType = match (true) {
            isAssoc($value1) && isAssoc($value2) => 'nested',
            $inFirst && $inSecond && ($value1 === $value2) => 'unchanged',
            $inFirst && $inSecond => 'changed',
            $inFirst => 'removed',
            $inSecond => 'added',
            default => throw new \Exception("Unknown diff between two values from files"),
        };
        $newTree[$key] = [];
        $newTree[$key]['name'] = $key;
        $newTree[$key]['type'] = $diffType;

        switch ($diffType) {
            case 'nested':
                $newTree[$key]['children'] = buildDiff($tree1[$key], $tree2[$key]);
                break;
        
            case 'unchanged':
                $newTree[$key]['value'] = $value1;
                break;
        
            case 'changed':
                $newTree[$key]['value1'] = $value1;
                $newTree[$key]['value2'] = $value2;
                break;
        
            case 'removed':
                $newTree[$key]['value1'] = $value1;
                break;
        
            case 'added':
                $newTree[$key]['value2'] = $value2;
                break;
            default:
                throw new \Exception("Unknown diff between two values from files");
        }
    }
    return $newTree;
}

function isAssoc(mixed $array): bool
{
    if (is_array($array)) {
        return array_keys($array) !== range(0, count($array) - 1);
    }
    return false;
}
