<?php

namespace Lookups\Actions\Traits;

use App\Http\Responses\IJSONResponse;

trait Addable
{
    public function createFromDTO(IJSONResponse $dto, array $whereClause = null) : IJSONResponse{
        $added = false;
        if(!is_null($this))
        {
            $data = $dto->toJSONResponse();
            if(is_array($whereClause) && count($whereClause) > 0)
            {
                $added = $this->createOrUpdate($whereClause, $data);
            }
            else
            {
                $added = $this->create($data);
            }
        }
        return $dto->fromDBModel($added);
    }
}