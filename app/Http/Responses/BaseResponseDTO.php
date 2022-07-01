<?php

declare(strict_types=1);

namespace App\Http\Responses;

use App\Enums\Http\StatusCode;

abstract class BaseResponseDTO implements IJSONResponse
{
    public ?bool $isError;
    public ?int $statusCode;
    public IJSONResponse $data;

    private function _set(IJSONResponse $data, int $statusCode, bool $isError): void
    {
        $this->data = $data;
        $this->statusCode = $statusCode;
        $this->isError = $isError;
    }

    protected function setError(IJSONResponse $data, ?int $statusCode): void
    {
        if (is_null($statusCode)) {
            $statusCode = StatusCode::ERROR_BAD_REQUEST_400;
        }
        $this->_set($data, $statusCode, true);
    }

    /**
     * Return successfull request. If data is null empty successful request will be sent.
     * @param IJSONResponse $data
     * @param StatusCode|null $statusCode
     */
    protected function setSuccess(IJSONResponse $data, ?int $statusCode): void
    {
        if (is_null($statusCode)) {
            $statusCode = StatusCode::SUCCESS_OK_200;
        }
        $this->_set($data, $statusCode, false);
    }

    /**
     * JSON response.
     * @return array
     */
    public function toJSONResponse(): array
    {
        if ($this->isError) {
            return [
                'error' => $this->data->toJSONResponse(),
            ];
        }

        return [
            'data' => $this->data->toJSONResponse(),
        ];
    }
}
