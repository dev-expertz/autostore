<?php

declare(strict_types=1);

namespace WebApi\Requests;

use App\Http\Responses\ErrorResponseDTO;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use WebApi\Responses\WebApiError;

class BaseApiRequest extends FormRequest
{
    protected function failedValidation(Validator $validator): void
    {
        $errorDTO = WebApiError::createValidationError($validator->getMessageBag()->first());
        throw new HttpResponseException(response()->json($errorDTO->toJSONResponse(), $errorDTO->statusCode));
    }

    protected function _throwErrorDTO(ErrorResponseDTO $errorDTO): void
    {
        throw new HttpResponseException(response()->json($errorDTO->toJSONResponse(), $errorDTO->statusCode));
    }

    public function all($keys = null): array
    {
        // Add route parameters to validation data
        return array_merge(parent::all(), $this->route()->parameters());
    }

    public function rules(): array
    {
        return [];
    }
}