<?php

require_once __DIR__ . '/../vendor/autoload.php';

use PHPUnit\Framework\TestCase;
use function Hexlet\Code\Gendiff\genDiff;

class CompareYamlTest extends TestCase
{
    public function testYamlGenDiff()
    {
        $pathToFile1 = __DIR__ . '/fixtures/file1.yml';
        $pathToFile2 = __DIR__ . '/fixtures/file2.yml';
        $expectedPath = __DIR__ . '/fixtures/expected.txt';
        $expected = file_get_contents($expectedPath);
        $actualResult = genDiff($pathToFile1, $pathToFile2);
        $this->assertEquals(trim($expected), trim($actualResult));
    }

    public function testYamlGenDiffSame()
    {
        $pathToFile1 = __DIR__ . '/fixtures/file1same.yml';
        $pathToFile2 = __DIR__ . '/fixtures/file2same.yml';
        $expectedPath = __DIR__ . '/fixtures/expectedSameFiles.txt';
        $expected = file_get_contents($expectedPath);
        $actualResult = genDiff($pathToFile1, $pathToFile2);
        $this->assertEquals(trim($expected), trim($actualResult));
    }
}
