<?php

require_once __DIR__ . '/../vendor/autoload.php';

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\DataProvider;
use function Differ\Formatters\Stylish\formatValueStylish;

class FormatValueStylishTest extends TestCase
{
    #[DataProvider('valuesProvider')]
    public function testFormatValueStylish($expected, $argument)
    {
        $value = 'test';
        $this->assertEquals($expected, formatValueStylish($argument));
    }

    public static function valuesProvider(): array
    {
        return [
            ['true', true],
            ['false', false],
            ['null', null],
            ['randomValue', 'randomValue'],
        ];
    }
}
