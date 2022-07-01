<?php

namespace App\Http\Responses;

interface IJSONResponse
{
    public function toJSONResponse(): array;
}
