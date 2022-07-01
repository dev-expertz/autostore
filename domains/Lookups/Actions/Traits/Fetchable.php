<?php

namespace Lookups\Actions\Traits;

trait Fetchable
{
    public function lookupGet($where, $skip = 0, $take = 1000){
        $data = false;
        if(!is_null($this))
        {
            if(is_array($where) && count($where) > 0)
            {
                $data = $this->where($where)->skip($skip)->take($take)->get();
            }
        }
        return json_decode(json_encode($data), true);
    }


}