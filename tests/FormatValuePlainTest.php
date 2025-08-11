<?php

namespace Differ\Tests;

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\DataProvider;

use function Differ\Formatters\Plain\formatValuePlain;

class FormatValuePlainTest extends TestCase
{
    #[DataProvider('valuesProvider')]
    public function testFormatValuePlain($expected, $argument)
    {
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
