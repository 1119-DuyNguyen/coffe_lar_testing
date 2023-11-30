<?php

namespace Tests\Unit;

use App\Http\Services\GateService;
use Closure;
use PHPUnit\Framework\TestCase;

class GetAdminAbilityTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function testTestCaseOne(): void
    {
        $gateAbility = "admin.category.index";
        $result = GateService::getAdminAbility($gateAbility);
        $this->assertTrue($result == array());
    }
    public function testTestCaseTwo(): void
    {
        $gateAbility = array("admin" => function () {},
        "user" => function () {});
        $result = GateService::getAdminAbility($gateAbility);
        $this->assertTrue($result == array("admin" => function () {}));
    }
}
