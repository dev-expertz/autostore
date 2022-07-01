<?php

declare(strict_types=1);

namespace Lookups\Actions;

use App\Enums\Http\StatusCode;
use App\Http\Responses\AssociativeArrayResponseDTO;
use App\Http\Responses\BaseResponseDTO;
use App\Http\Responses\IJSONResponse;
use Lookups\Models\LookupsBaseModel;

class CreateLookupAction
{
    public LookupsBaseModel $lookup;
    public IJSONResponse $dto;
    public ProcessImagesAction $imagesAction;

    public function __construct(LookupsBaseModel $model, IJSONResponse $dto = null, ProcessImagesAction $imagesAction = null)
    {
        $this->lookup = $model;
        $this->dto = $dto;
        $this->imagesAction = isset($imagesAction) && $imagesAction != null ? $imagesAction : new ProcessImagesAction($model, $dto);
    }

    public function __invoke(IJSONResponse $dto = null) : BaseResponseDTO
    {
        if($dto != null)
        {
            $this->dto = $dto;
        }
        if(isset($this->dto->id) && !is_null($this->dto->id) && intval($this->dto->id) > 0)
        {

            $response = $this->lookup->updateFromDTO($this->dto, ["id" => $this->dto->id]);
            $response = ["id" => $this->dto["id"], "update" => $response];
        }
        else
        {
            $response = $this->lookup->createFromDTO($this->dto);
        }
        if(isset($data["images"]))
        {
            ($this->imagesAction)($response, $data["images"]);
        }
        return new AssociativeArrayResponseDTO(StatusCode::SUCCESS_OK_200, "item", $response->toJSONResponse());
    }
}