<?php

namespace Tests\Unit\Lookups\Actions;

use Lookups\Actions\FetchLookupItemsAction;
use Lookups\DataTransferObjects\LookupItemsRequestDTO;
use Lookups\Models\VehicleMake;
use Tests\TestCase;

class FetchLookupItemsActionTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_fetch_active_vehicle_make()
    {
        $actionResult = (new FetchLookupItemsAction(new VehicleMake(), new LookupItemsRequestDTO()))();
        $this->assertEquals(200, $actionResult->statusCode, "Successfully Fetched");
        $this->assertGreaterThan(0, count($actionResult->data->data["items"]), "Successfully Fetched Items");
    }
}
