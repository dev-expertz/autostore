<?php

namespace App\Http\Responses;

use App\Enums\Http\StatusCode;

class BulkResponseDTO extends BaseResponseDTO
{
    use JSONResponseTrait;

    /**
     * @var BulkItemDTO[]
     */
    private array $_bulkItems;

    /**
     * SettingsAPIResponseDTO constructor.
     * @param BulkItemDTO[] $data
     */
    public function __construct(array $data)
    {
        $this->isError = false;
        $this->_bulkItems = $data;
        $this->statusCode = StatusCode::SUCCESS_MULTI_STATUS_207;
    }

    /**
     * @param IJSONResponse $data
     * @return array
     */
    protected function _toArrayOfJsonResponses(array $data): array
    {
        $out = [];
        if (! empty($data)) {
            foreach ($data as $item) {
                $out[] = $item->toJSONResponse();
            }
        }

        return $out;
    }

    public function toJSONResponse(): array
    {
        return [
            'data' => $this->_toJSONResponseFromIJSONResponse($this->_bulkItems),
        ];
    }
}
