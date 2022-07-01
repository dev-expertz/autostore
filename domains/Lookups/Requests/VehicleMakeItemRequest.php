<?php

declare(strict_types=1);

namespace Lookups\Requests;

use WebApi\Requests\BaseApiRequest;

final class VehicleMakeItemRequest extends BaseApiRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'id' => 'nullable|integer',
            'name' => 'required|string',
            'short_code' => 'required|string',
            'short_description' => 'nullable|string',
            'year_ranges' => 'nullable|array',
            'primary_logo_path' => 'nullable|string',
            'primary_image_path' => 'nullable|string',
            'is_active' => 'nullable|integer',
            'is_archived' => 'nullable|integer',
            'created_at' => 'nullable|string',
            'updated_at' => 'nullable|string'
        ];
    }
}