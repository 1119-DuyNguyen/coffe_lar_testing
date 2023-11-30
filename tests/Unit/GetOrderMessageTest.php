<?php

namespace Tests\Unit;

use App\Enums\OrderStatus;
use Tests\TestCase;

class GetOrderMessageTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function testTestCaseOne(): void
    {
        $orderStatus = "pending";
        $result = OrderStatus::getMessage($orderStatus);
        $this->assertTrue($result == array('status' => __('pending'),
        'details' => __('pending_details')));
    }
    public function testTestCaseTwo(): void
    {
        $orderStatus = "processed_and_ready_to_ship";
        $result = OrderStatus::getMessage($orderStatus);
        $this->assertTrue($result == array('status' => __('processed_and_ready_to_ship'),
        'details' => __('processed_and_ready_to_ship_details')));
    }
    public function testTestCaseThree(): void
    {
        $orderStatus = "out_for_delivery";
        $result = OrderStatus::getMessage($orderStatus);
        $this->assertTrue($result == array('status' => __('out_for_delivery'),
        'details' => __('out_for_delivery_details')));
    }
    public function testTestCaseFour(): void
    {
        $orderStatus = "canceled";
        $result = OrderStatus::getMessage($orderStatus);
        $this->assertTrue($result == array('status' => __('canceled'),
        'details' => __('canceled_details')));
    }
}
