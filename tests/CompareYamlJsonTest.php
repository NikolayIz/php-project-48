<?php

require_once __DIR__ . '/../vendor/autoload.php';

use PHPUnit\Framework\TestCase;
use function Hexlet\Code\Differ\Differ\genDiff;

class CompareYamlJsonTest extends TestCase
{
    public function testYamlJsonGenDiff()
    {
        $pathToFile1 = __DIR__ . '/fixtures/file1.yml';
        $pathToFile2 = __DIR__ . '/fixtures/file2.json';
        $expectedPath = __DIR__ . '/fixtures/expected.txt';
        $expected = file_get_contents($expectedPath);
        $actualResult = genDiff($pathToFile1, $pathToFile2);
        $this->assertEquals(trim($expected), trim($actualResult));
    }

    public function testYamlJsonGenDiffSame()
    {
        $pathToFile1 = __DIR__ . '/fixtures/file1same.yml';
        $pathToFile2 = __DIR__ . '/fixtures/file2same.json';
        $expectedPath = __DIR__ . '/fixtures/expectedSameFiles.txt';
        $expected = file_get_contents($expectedPath);
        $actualResult = genDiff($pathToFile1, $pathToFile2);
        $this->assertEquals(trim($expected), trim($actualResult));
    }

    public function testYamlJsonGenDiffNested()
    {
        $pathToFile1 = __DIR__ . '/fixtures/file1nested.yml';
        $pathToFile2 = __DIR__ . '/fixtures/file2nested.json';
        $expectedPath = __DIR__ . '/fixtures/expectedNested.txt';
        $expected = file_get_contents($expectedPath);
        $actualResult = genDiff($pathToFile1, $pathToFile2);
        $this->assertEquals(trim($expected), trim($actualResult));
    }

    public function testYamlJsonGenDiffPlain()
    {
        $pathToFile1 = __DIR__ . '/fixtures/file1nested.yml';
        $pathToFile2 = __DIR__ . '/fixtures/file2nested.json';
        $expectedPath = __DIR__ . '/fixtures/expectedPlain.txt';
        $expected = file_get_contents($expectedPath);
        $actualResult = genDiff($pathToFile1, $pathToFile2, 'plain');
        $this->assertEquals(trim($expected), trim($actualResult));
    }

    public function testYamlJsonGenDiffJson()
    {
        $pathToFile1 = __DIR__ . '/fixtures/file1nested.yml';
        $pathToFile2 = __DIR__ . '/fixtures/file2nested.json';
        $expectedPath = __DIR__ . '/fixtures/expectedJson.txt';
        $expected = file_get_contents($expectedPath);
        $actualResult = genDiff($pathToFile1, $pathToFile2, 'json');
        $this->assertEquals(trim($expected), trim($actualResult));
    }
}
