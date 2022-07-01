<?php

namespace Lookups\Actions\Traits;

trait Listable
{
    public function list($where, $offset = 0, $length = 20)
    {
        return $this->where($where)->skip($offset)->take($length)->get();
    }

    public function activeList($offset = 0, $length = 20)
    {
        return $this->whereActive()->skip($offset)->take($length)->get();
    }
}