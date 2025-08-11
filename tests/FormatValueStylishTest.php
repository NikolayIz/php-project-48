<?php

namespace Differ\Tests;

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\DataProvider;
use function Differ\Formatters\Stylish\formatValueStylish;

class FormatValueStylishTest extends TestCase
{
    #[DataProvider('valuesProvider')]
    public function testFormatValueStylish($expected, $argument)
    {
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
