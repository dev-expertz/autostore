<?php

namespace Lookups\Actions\Traits;

use App\Http\Responses\IJSONResponse;

trait Deleteable
{
    public function deleteFromDTO(IJSONResponse $where, string $softDeleteColumn = null, bool $softDelete = null) : array{
        $updated = false;
        if(!is_null($this))
        {
            if($softDeleteColumn == null)
            {
                $softDeleteColumn = "is_archived";
            }
            if($softDelete == null)
            {
                $softDelete = true;
            }
            $whereClause = ($where != null) ? $where->toJSONResponse() : [];
            if(is_array($whereClause) && count($whereClause) > 0)
            {
                if($softDelete)
                {
                    $updated = $this->where($whereClause)->update([$softDeleteColumn => 1]);
                }
                else
                {
                    $updated = $this->where($whereClause)->delete();
                }
            }
        }
        return ["where" => $where, "deleted" => $updated];
    }
}