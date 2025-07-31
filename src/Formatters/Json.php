<?php

namespace Hexlet\Code\Formatters\Json;

function formatterJson(array $tree)
{
    return json_encode($tree, JSON_PRETTY_PRINT) . "\n";
}
