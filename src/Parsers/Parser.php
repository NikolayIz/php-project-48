<?php

namespace Hexlet\Code\Parsers\Parser;

function parseFile($content): array
{
    $data = json_decode($content);
    return get_object_vars($data);
}
