<?php

namespace Hexlet\Code\Gendiff;

use function Hexlet\Code\Parser\parseFile;
use function Funct\Collection\sortBy;

function genDiff($pathToFile1, $pathToFile2): string
{
    $dataFile1 = file_get_contents(realpath($pathToFile1));
    $dataFile2 = file_get_contents(realpath($pathToFile2));
    $decoded1 = get_object_vars(json_decode($dataFile1));
    $decoded2 = get_object_vars(json_decode($dataFile2));

    $sortedDecoded1 = sortBy($decoded1, fn($value) => $value, 'ksort');
    $sortedDecoded2 = sortBy($decoded2, fn($value) => $value, 'ksort');
    //отсортировал теперь надо сравнивать научиться пока хз как это делать предположительно используя мап редусе фильтр
    return json_encode($sortedDecoded1);
}