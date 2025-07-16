<?php

namespace Hexlet\Code\Parsers\Parser;

use Symfony\Component\Yaml\Yaml;

function parseFile($pathToFile): object
{
    $content = file_get_contents(realpath($pathToFile));
    $extention = pathinfo($pathToFile, PATHINFO_EXTENSION);

    $parser = getParserByExtension($extension);
    return $parser($content);
}

function getParserByExtension(string $extension): callable
{
    return match (strtolower($extension)) {
        'json' => __NAMESPACE__ . "\\parseJsonFile",
        'yml', 'yaml' => __NAMESPACE__ . "\\parseYamlFile",
        default => throw new \Exception("Unsupported format: $extension"),
    };
}

function parseJsonFile(string $content): object
{
    return json_decode($content);
}

function parseYamlFile(string $content): object
{
    return Yaml::parse($content, Yaml::PARSE_OBJECT_FOR_MAP);
}
