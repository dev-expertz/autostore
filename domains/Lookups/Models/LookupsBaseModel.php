<?php

namespace Lookups\Models;

use App\Models\BaseModel;
use Lookups\Actions\Traits\Addable;
use Lookups\Actions\Traits\Deleteable;
use Lookups\Actions\Traits\Fetchable;
use Lookups\Actions\Traits\Listable;
use Lookups\Actions\Traits\Updateable;
use Lookups\QueryBuilders\LookupItemsQueryBuilder;

abstract class LookupsBaseModel extends BaseModel
{
    use Addable, Updateable, Deleteable, Fetchable, Listable;

    public function newEloquentBuilder($query) : LookupItemsQueryBuilder
    {
        return new LookupItemsQueryBuilder($query);
    }
}