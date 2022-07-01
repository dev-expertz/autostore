<?php

namespace Tests\Unit\Lookups\Actions;

use App\Helpers\StrExtended;
use Lookups\DataTransferObjects\VehicleMakeDTO;
use Lookups\Models\VehicleMake;
use Lookups\Requests\VehicleMakeItemRequest;
use Illuminate\Support\Str;
use Tests\TestCase;
use Lookups\Actions\CreateLookupAction;

class CreateLookupActionTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_vehicle_make_creation()
    {
        $make = new VehicleMake();
        $dto = VehicleMakeDTO::fromStoreRequest(new VehicleMakeItemRequest(["name" => Str::random(10), "short_code" => Str::random(10)]));
        $actionResult = (new CreateLookupAction($make, $dto))();
        $this->assertEquals(200, $actionResult->statusCode, "Successfully Created");
        $this->assertGreaterThan(0, $actionResult->data->data["id"], "Successfully Created");
    }
}
