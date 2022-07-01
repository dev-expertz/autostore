<?php

namespace App\Http\Responses;

use App\Support\Helpers\ArrExtended;

class BulkItemDTO extends BaseResponseDTO
{
    private ?array $_inputRequest;
    private ?IJSONResponse $_meta;

    public function __construct(array $request, IJSONResponse $meta, IJSONResponse $data, ?int $httpStatus)
    {
        $this->_inputRequest = $request;
        $this->_meta = $meta;
        $this->data = $data;
        if ($this->data instanceof ErrorItemDTO) {
            $this->statusCode = $data->statusCode;
        } else {
            $this->statusCode = $httpStatus;
        }
    }

    public function toJSONResponse(): array
    {
        $out = ArrExtended::filterNulls([
            'status_code' => $this->statusCode,
            'request' => $this->_inputRequest,
            'meta' => $this->_meta,
        ]);

        if ($this->isError) {
            $out['error'] = $this->data->toJSONResponse();
        } else {
            $out['data'] = $this->data->toJSONResponse();
        }

        return $out;
    }
}
