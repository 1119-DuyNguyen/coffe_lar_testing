<?php

namespace Tests\Unit;

use App\Http\Services\SettingService;
use PHPUnit\Framework\TestCase;

class ArrayOverrideTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function test_case_1(): void
    {
        $this->assertEquals(SettingService::array_override(["title" => "caphe"], ["title" => "override"]), ["title" => "override"]);
    }
}
