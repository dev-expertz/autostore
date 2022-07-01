<?php

namespace Lookups\Actions\Traits;

use App\Http\Responses\IJSONResponse;

trait Updateable
{
    public function filterData(array $fillable = [], array $json_data = []) : array{
        $return_data = array();
        foreach($fillable AS $update_column)
        {
            if(is_array($json_data) && array_key_exists($update_column, $json_data))
            {
                $return_data[$update_column] = $json_data[$update_column];
            }
            else if(is_object($json_data) && property_exists($json_data, $update_column))
            {
                $return_data[$update_column] = $json_data->$update_column;
            }

            if(isset($return_data[$update_column]) && is_array($return_data[$update_column]))
            {
                $return_data[$update_column] = json_encode($return_data[$update_column]);
            }
        }

        return $return_data;
    }
    public function updateFromDTO(IJSONResponse $dto, array $whereClause = []) : array{
        $updated = false;
        if(!is_null($this))
        {
            $data = $this->filterData($this->fillable, $dto->toJSONResponse());
            if(is_array($whereClause) && count($whereClause) > 0)
            {
                $updated = $this->where($whereClause)->update($data);
            }
        }
        return ["where" => $whereClause, "updated" => $updated];
    }
}