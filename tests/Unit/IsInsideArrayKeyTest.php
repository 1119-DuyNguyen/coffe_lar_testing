<?php

namespace Tests\Unit;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class IsInsideArrayKeyTest extends TestCase
{
    public static function data(): array
    {
        return [
            [true, "456", "test2", ["test" => 123, "test2" => "456"]],
            [false, "123", "test", []],
        ];
    }

    #[DataProvider('data')]
    public function testIsSameValueArrayAtKey($value, $valueCheck, $keyCheck, $array): void
    {
        $this->assertEquals($value, isInsideArrayKey($valueCheck, $keyCheck, $array));
    }
}
