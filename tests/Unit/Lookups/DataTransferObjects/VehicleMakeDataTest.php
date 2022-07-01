<?php

namespace Tests\Unit\Lookups\DataTransferObjects;

use Tests\TestCase;

use Lookups\DataTransferObjects\VehicleMakeDTO;
use Lookups\Requests\VehicleMakeItemRequest;
use TypeError;

class VehicleMakeDataTest extends TestCase
{
    /**
     *
     * @return void
     */
    public function test_from_store_request()
    {
        $dto = VehicleMakeDTO::fromStoreRequest(new VehicleMakeItemRequest(["name" => "BMW", "short_code" => "bmw"]));
        $this->assertInstanceOf(VehicleMakeDTO::class, $dto);
    }

    /**
     *
     * @return void
     */
    public function test_from_store_request_without_name_fails()
    {
        $this->expectException(TypeError::class);
        $dto = VehicleMakeDTO::fromStoreRequest(new VehicleMakeItemRequest([]));      
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_from_store_request_without_short_code_fails()
    {
        $this->expectException(TypeError::class);
        $dto = VehicleMakeDTO::fromStoreRequest(new VehicleMakeItemRequest(["name" => "BMW"]));      
    }
}
