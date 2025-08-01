<?php

require_once __DIR__ . '/../vendor/autoload.php';

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\DataProvider;
use function Differ\Formatters\Plain\formatValuePlain;

class FormatValuePlainTest extends TestCase
{
    #[DataProvider('valuesProvider')]
    public function testFormatValuePlain($expected, $argument)
    {
        $value = 'test';
        $this->assertEquals($expected, formatValuePlain($argument));
    }

    public static function valuesProvider(): array
    {
        return [
            ['true', true],
            ['false', false],
            ['null', null],
            ["'randomValue'", "randomValue"],
            ['[complex value]', []],
        ];
    }
}
