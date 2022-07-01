<?php

namespace Lookups\DataTransferObjects;

use App\Helpers\ArrayExtended;
use App\Http\Responses\IJSONResponse;
use Illuminate\Database\Eloquent\Collection;

class LookupItemsDTO implements IJSONResponse
{
    public ?array $items;
    public ?int $total;

    public function __construct(
        ?array $items,
        ?int $total = null
    ) {
        $this->items = $items;
        $this->total = $total;
    }

    public static function fromDBModel(Collection $items): self
    {
        return new self(
            json_decode(json_encode($items), true)
        );
    }

    public function toJSONResponse(): array
    {
        return ArrayExtended::filterNulls([
            'items' => $this->items,
            'total' => $this->total
        ]);
    }
}