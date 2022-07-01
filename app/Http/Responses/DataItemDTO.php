<?php

namespace App\Http\Responses;

use App\Helpers\ArrayExtended;

class DataItemDTO implements IJSONResponse
{
    public array $data;
    public string $property;

    public function __construct(string $property, array $data)
    {
        $this->data = $data;
        $this->property = $property;
    }

    public function toJSONResponse(): array
    {
        return [$this->property => ArrayExtended::filterNulls($this->data)];
    }
}
