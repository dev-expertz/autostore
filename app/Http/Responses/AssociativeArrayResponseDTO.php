<?php

namespace App\Http\Responses;

use App\Enums\Http\StatusCode;

class AssociativeArrayResponseDTO extends BaseResponseDTO
{
    /**
     * SimpleAssociativeArrResponseDTO constructor.
     * @param int $statusCode
     * @param string|null $property
     * @param array $singleLvlAssociativeArray
     */
    public function __construct(int $statusCode, ?string $property, array $singleLvlAssociativeArray)
    {
        $this->setSuccess(new DataItemDTO($property, $singleLvlAssociativeArray), $statusCode);
    }
}
