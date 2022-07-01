<?php

namespace App\Http\Responses;

trait JSONResponseTrait
{
    /**
     * @param IJSONResponse[]|null $data
     * @return array|null
     */
    protected function _toJSONResponseFromIJSONResponse(?array $data): ?array
    {
        if (is_null($data)) {
            return $data;
        }

        $out = [];
        if (! empty($data)) {
            foreach ($data as $item) {
                $out[] = $item->toJSONResponse();
            }
        }

        return $out;
    }
}
