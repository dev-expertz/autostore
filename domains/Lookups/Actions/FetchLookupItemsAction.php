<?php

declare(strict_types=1);

namespace Lookups\Actions;

use App\Enums\Http\StatusCode;
use App\Http\Responses\AssociativeArrayResponseDTO;
use App\Http\Responses\BaseResponseDTO;
use Lookups\DataTransferObjects\LookupItemsDTO;
use Lookups\DataTransferObjects\LookupItemsRequestDTO;
use Lookups\Models\LookupsBaseModel;

class FetchLookupItemsAction
{
    public LookupsBaseModel $lookup;
    public LookupItemsRequestDTO $dto;

    public function __construct(LookupsBaseModel $model, LookupItemsRequestDTO $dto = null)
    {
        $this->lookup = $model;
        $this->dto = $dto;
    }
    public function __invoke(LookupItemsRequestDTO $itemsRequestDTO = null) : BaseResponseDTO
    {
        if($itemsRequestDTO != null)
        {
            $this->dto = $itemsRequestDTO;
        }
        $items = $this->lookup->activeList($this->dto->offset, $this->dto->length);
        $response = LookupItemsDTO::fromDBModel($items);
       
        return new AssociativeArrayResponseDTO(StatusCode::SUCCESS_OK_200, "items", $response->toJSONResponse());
    }
}