<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Lookups\DataTransferObjects\LookupItemsRequestDTO;
use Lookups\DataTransferObjects\VehicleMakeDTO;
use Lookups\Models\VehicleMake;
use Lookups\Requests\LookupItemsRequest;
use Lookups\Requests\VehicleMakeItemRequest;
use WebApi\Services\Lookups\CreateLookupAction;
use WebApi\Services\Lookups\FetchLookupItemsAction;
use WebApi\Services\Lookups\UpdateLookupAction;

class VehicleMakeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum', ["except" => ["index"]]);
    }
    /**
     * @return JsonResponse
     *
     * */
    public function index(LookupItemsRequest $request): JsonResponse
    {
        $itemsRequestDTO = LookupItemsRequestDTO::fromLookItemsRequest($request);
        $lookupAction = new FetchLookupItemsAction(new VehicleMake(), $itemsRequestDTO);

        return $this->handleResponse($lookupAction->__invoke());
    }
    /**
     * @return JsonResponse
     *
     * */
    public function store(VehicleMakeItemRequest $request): JsonResponse
    {
        $vehicleMakeDTO = VehicleMakeDTO::fromStoreRequest($request);
        $lookupAction = new CreateLookupAction(new VehicleMake(), $vehicleMakeDTO);

        return $this->handleResponse($lookupAction->__invoke());
    }

    /**
     * @return JsonResponse
     *
     * */
    public function update(VehicleMakeItemRequest $request, $id): JsonResponse
    {
        $vehicleMakeDTO = VehicleMakeDTO::fromStoreRequest($request);
        $lookupAction = new UpdateLookupAction(new VehicleMake(), $vehicleMakeDTO);

        return $this->handleResponse($lookupAction->__invoke());
    }
}
