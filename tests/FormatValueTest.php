<?php

require_once __DIR__ . '/../vendor/autoload.php';

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\DataProvider;
use function Hexlet\Code\Formatters\Stylish\formatValue;

class FormatValueTest extends TestCase
{
    #[DataProvider('valuesProvider')]
    public function testFormatValue($expected, $argument)
    {
        $value = 'test';
        $this->assertEquals($expected, formatValue($argument));
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
