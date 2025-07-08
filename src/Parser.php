<?php

namespace Hexlet\Code\Parser;

function parseFile($content): array
{
    $data = json_decode($content);
    return get_object_vars($data);
}
