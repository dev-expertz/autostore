<?php

namespace Tests\Unit\Lookups\Actions;

use Lookups\Actions\UpdateLookupAction;
use Lookups\DataTransferObjects\VehicleMakeDTO;
use Lookups\Models\VehicleMake;
use Illuminate\Support\Str;
use Lookups\Requests\VehicleMakeItemRequest;
use Tests\TestCase;

class UpdateLookupActionTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_update_vehicle_make()
    {
        $updateid = 2;
        $make = new VehicleMake();
        $newName = Str::random(10);
        $newCode = Str::random(10);
        $dto = VehicleMakeDTO::fromStoreRequest(new VehicleMakeItemRequest(["id" => $updateid, "name" => $newName, "short_code" => $newCode]));
        $actionResult = (new UpdateLookupAction($make, $dto))();
        $this->assertEquals(200, $actionResult->statusCode, "Successfully Updated");
        $this->assertEquals($updateid, $actionResult->data->data["id"], "Successfully Updated");
        $this->assertGreaterThan(0, $actionResult->data->data["update"]["updated"], "Successfully Updated");
    }
}
