<?php

namespace Differ\Formatters\Json;

function formatterJson(array $tree): string
{
    return json_encode($tree, JSON_PRETTY_PRINT) . "\n";
}
