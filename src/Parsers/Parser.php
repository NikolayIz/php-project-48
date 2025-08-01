<?php

namespace Differ\Parsers\Parser;

use Symfony\Component\Yaml\Yaml;

function parseFile(string $pathToFile): array
{
    $content = file_get_contents(realpath($pathToFile));
    $extension = pathinfo($pathToFile, PATHINFO_EXTENSION);

    if (empty($extension)) {
        die("ERROR: Cannot determine file format: file has no extension");
    }

    $parser = getParserByExtension($extension);
    return $parser($content);
}

function getParserByExtension(string $extension): callable
{
    return match (strtolower($extension)) {
        'json' => __NAMESPACE__ . "\\parseJsonFile",
        'yml', 'yaml' => __NAMESPACE__ . "\\parseYamlFile",
        default => die("ERROR: Unsupported format: $extension"),
    };
}

function parseJsonFile(string $content): array
{
    return json_decode($content, true);
}

function parseYamlFile(string $content): array
{
    return Yaml::parse($content);
}
