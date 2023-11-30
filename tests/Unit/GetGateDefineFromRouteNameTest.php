<?php

namespace Tests\Unit;

use App\Http\Services\GateService;
use PHPUnit\Framework\TestCase;

class GetGateDefineFromRouteNameTest extends TestCase
{
    // GetGateDefineFromRouteName
    /**
     * A basic unit test example.
     */
    public function testTestCaseOne(): void
    {
        $result = GateService::getGateDefineFromRouteName("admin.category.edit");
        $this->assertTrue($result == "admin.category.update");
    }
    public function testTestCaseTwo(): void
    {
        $result = GateService::getGateDefineFromRouteName("admin.category.create");
        $this->assertTrue($result == "admin.category.store");
    }
}
