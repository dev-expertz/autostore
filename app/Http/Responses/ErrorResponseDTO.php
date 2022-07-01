<?php

declare(strict_types=1);

namespace App\Http\Responses;

class ErrorResponseDTO extends BaseResponseDTO
{
    public function __construct(ErrorItemDTO $data)
    {
        $this->setError($data, $data->statusCode);
    }
}
