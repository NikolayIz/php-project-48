<?php

namespace Differ\Tests;

require_once __DIR__ . '/../vendor/autoload.php';

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\DataProvider;
use function Differ\Differ\genDiff;

class GenDiffTest extends TestCase
{
    #[DataProvider('valuesProvider')]
    public function testGendiff(string $path1, string $path2, string $expectedPath, string $format = 'stylish')
    {
        $expected = file_get_contents($expectedPath);
        $actual = genDiff($path1, $path2, $format);
        $this->assertEquals(trim($expected), trim($actual));
    }

    public static function valuesProvider(): array
    {
        $baseDir = __DIR__ . '/fixtures/';
        return [
            'flat json files' => [
                $baseDir . 'file1.json',
                $baseDir . 'file2.json',
                $baseDir . 'expected.txt',
                'stylish',
            ],
            'same json files' => [
                $baseDir . 'file1same.json',
                $baseDir . 'file2same.json',
                $baseDir . 'expectedSameFiles.txt',
                'stylish',
            ],
            'nested json files' => [
                $baseDir . 'file1nested.json',
                $baseDir . 'file2nested.json',
                $baseDir . 'expectedNested.txt',
                'stylish',
            ],
            'nested plain json format' => [
                $baseDir . 'file1nested.json',
                $baseDir . 'file2nested.json',
                $baseDir . 'expectedPlain.txt',
                'plain',
            ],
            'nested json format' => [
                $baseDir . 'file1nested.json',
                $baseDir . 'file2nested.json',
                $baseDir . 'expectedJson.txt',
                'json',
            ],

            'flat yaml files' => [
                $baseDir . 'file1.yml',
                $baseDir . 'file2.yml',
                $baseDir . 'expected.txt',
                'stylish',
            ],
            'same yml files' => [
                $baseDir . 'file1same.yml',
                $baseDir . 'file2same.yml',
                $baseDir . 'expectedSameFiles.txt',
                'stylish',
            ],
            'nested yml files' => [
                $baseDir . 'file1nested.yml',
                $baseDir . 'file2nested.yml',
                $baseDir . 'expectedNested.txt',
                'stylish',
            ],
            'nested plain yaml format' => [
                $baseDir . 'file1nested.yml',
                $baseDir . 'file2nested.yml',
                $baseDir . 'expectedPlain.txt',
                'plain',
            ],
            'nested yaml format' => [
                $baseDir . 'file1nested.yml',
                $baseDir . 'file2nested.yml',
                $baseDir . 'expectedJson.txt',
                'json',
            ],

            'flat json-yaml files' => [
                $baseDir . 'file1.json',
                $baseDir . 'file2.yml',
                $baseDir . 'expected.txt',
                'stylish',
            ],
            'same json-yml files' => [
                $baseDir . 'file1same.json',
                $baseDir . 'file2same.yml',
                $baseDir . 'expectedSameFiles.txt',
                'stylish',
            ],
            'nested json-yml files' => [
                $baseDir . 'file1nested.json',
                $baseDir . 'file2nested.yml',
                $baseDir . 'expectedNested.txt',
                'stylish',
            ],
            'nested plain json-yaml format' => [
                $baseDir . 'file1nested.json',
                $baseDir . 'file2nested.yml',
                $baseDir . 'expectedPlain.txt',
                'plain',
            ],
            'nested json-yaml format' => [
                $baseDir . 'file1nested.json',
                $baseDir . 'file2nested.yml',
                $baseDir . 'expectedJson.txt',
                'json',
            ],

            'flat yaml-json files' => [
                $baseDir . 'file1.yml',
                $baseDir . 'file2.json',
                $baseDir . 'expected.txt',
                'stylish',
            ],
            'same yaml-json files' => [
                $baseDir . 'file1same.yml',
                $baseDir . 'file2same.yml',
                $baseDir . 'expectedSameFiles.txt',
                'stylish',
            ],
            'nested yaml-json files' => [
                $baseDir . 'file1nested.yml',
                $baseDir . 'file2nested.json',
                $baseDir . 'expectedNested.txt',
                'stylish',
            ],
            'nested plain yaml-json format' => [
                $baseDir . 'file1nested.yml',
                $baseDir . 'file2nested.json',
                $baseDir . 'expectedPlain.txt',
                'plain',
            ],
            'nested yaml-json format' => [
                $baseDir . 'file1nested.yml',
                $baseDir . 'file2nested.json',
                $baseDir . 'expectedJson.txt',
                'json',
            ]
        ];
    }
}