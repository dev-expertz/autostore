<?php

declare(strict_types=1);

namespace Lookups\Requests;

use WebApi\Requests\BaseApiRequest;

final class LookupItemsRequest extends BaseApiRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'length' => 'nullable|integer',
            'page' => 'nullable|integer',
            'offset' => 'nullable|integer',
            'is_active' => 'nullable|integer',
            'is_archived' => 'nullable|integer'
        ];
    }
}