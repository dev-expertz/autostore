<?php

declare(strict_types=1);

namespace Lookups\Actions;

use App\Helpers\StorageExtended;
use App\Http\Responses\IJSONResponse;
use Lookups\Models\LookupsBaseModel;

class ProcessImagesAction
{
    public LookupsBaseModel $lookup;
    public IJSONResponse $dto;

    public function __construct(LookupsBaseModel $model, IJSONResponse $dto = null)
    {
        $this->lookup = $model;
        $this->dto = $dto;
    }

    public function __invoke(IJSONResponse $dto, array $images = [])
    {
        if(isset($dto->id) && is_array($images) && count($images) > 0)
        {
            foreach($images AS $image)
            {
                StorageExtended::storeImage($image, "./basicsetups/".get_class($this->lookup)."/".$dto->id."/");
            }
        }
    }
}