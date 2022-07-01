<?php

declare(strict_types=1);

namespace App\Http\Responses;

use App\Helpers\ArrayExtended;

class ErrorItemDTO implements IJSONResponse
{
    public string $errorId;
    public string $systemMessage;
    public ?string $errorDetails;
    public ?int $statusCode;

    public function __construct(string $errorId, string $systemMessage, ?string $errorDetails, ?int $statusCode)
    {
        $this->errorId = $errorId;
        $this->systemMessage = $systemMessage;
        $this->errorDetails = $errorDetails;
        $this->statusCode = $statusCode;
    }

    public function toJSONResponse(): array
    {
        return ArrayExtended::filterNulls([
            'id' => $this->errorId,
            'message' => $this->systemMessage,
            'details' => $this->errorDetails,
        ]);
    }
}
