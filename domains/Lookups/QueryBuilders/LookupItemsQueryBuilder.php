<?php

namespace Lookups\QueryBuilders;

use Illuminate\Database\Eloquent\Builder;

class LookupItemsQueryBuilder extends Builder
{
    public function whereActive() : self
    {
        return $this->where("is_active", 1)->where("is_archived", 0);
    }
}