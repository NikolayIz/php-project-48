<?php

namespace Differ\Tests;

require_once __DIR__ . '/../vendor/autoload.php';

use PHPUnit\Framework\TestCase;
use function Differ\Differ\genDiff;

class CompareJsonYamlTest extends TestCase
{
    public function testJsonYamlGenDiff()
    {
        $pathToFile1 = __DIR__ . '/fixtures/file1.json';
        $pathToFile2 = __DIR__ . '/fixtures/file2.yml';
        $expectedPath = __DIR__ . '/fixtures/expected.txt';
        $expected = file_get_contents($expectedPath);
        $actualResult = genDiff($pathToFile1, $pathToFile2);
        $this->assertEquals(trim($expected), trim($actualResult));
    }

    public function testJsonYamlGenDiffSame()
    {
        $pathToFile1 = __DIR__ . '/fixtures/file1same.json';
        $pathToFile2 = __DIR__ . '/fixtures/file2same.yml';
        $expectedPath = __DIR__ . '/fixtures/expectedSameFiles.txt';
        $expected = file_get_contents($expectedPath);
        $actualResult = genDiff($pathToFile1, $pathToFile2);
        $this->assertEquals(trim($expected), trim($actualResult));
    }

    public function testJsonYamlGenDiffNested()
    {
        $pathToFile1 = __DIR__ . '/fixtures/file1nested.json';
        $pathToFile2 = __DIR__ . '/fixtures/file2nested.yml';
        $expectedPath = __DIR__ . '/fixtures/expectedNested.txt';
        $expected = file_get_contents($expectedPath);
        $actualResult = genDiff($pathToFile1, $pathToFile2);
        $this->assertEquals(trim($expected), trim($actualResult));
    }

    public function testJsonYamlGenDiffPlain()
    {
        $pathToFile1 = __DIR__ . '/fixtures/file1nested.json';
        $pathToFile2 = __DIR__ . '/fixtures/file2nested.yml';
        $expectedPath = __DIR__ . '/fixtures/expectedPlain.txt';
        $expected = file_get_contents($expectedPath);
        $actualResult = genDiff($pathToFile1, $pathToFile2, 'plain');
        $this->assertEquals(trim($expected), trim($actualResult));
    }

    public function testJsonYamlGenDiffJson()
    {
        $pathToFile1 = __DIR__ . '/fixtures/file1nested.json';
        $pathToFile2 = __DIR__ . '/fixtures/file2nested.yml';
        $expectedPath = __DIR__ . '/fixtures/expectedJson.txt';
        $expected = file_get_contents($expectedPath);
        $actualResult = genDiff($pathToFile1, $pathToFile2, 'json');
        $this->assertEquals(trim($expected), trim($actualResult));
    }
}
