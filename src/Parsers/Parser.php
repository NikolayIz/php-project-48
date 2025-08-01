<?php

namespace Differ\Parsers\Parser;

use Symfony\Component\Yaml\Yaml;

function parseFile(string $pathToFile): array
{
    $realPath = realpath($pathToFile);
    if ($realPath === false) {
        throw new \InvalidArgumentException("ERROR: File not found at path: $pathToFile");
    }
    $content = file_get_contents($realPath);
    $extension = pathinfo($pathToFile, PATHINFO_EXTENSION);

    if ($extension === '') {
        throw new \InvalidArgumentException("Extension '{$extension}' is not valid.");
    }

    $parser = getParserByExtension($extension);
    return $parser($content);
}

function getParserByExtension(string $extension): callable
{
    return match (strtolower($extension)) {
        'json' => __NAMESPACE__ . "\\parseJsonFile",
        'yml', 'yaml' => __NAMESPACE__ . "\\parseYamlFile",
        default => throw new \InvalidArgumentException("Unsupported format: '$extension'"),
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
