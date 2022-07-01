<?php

namespace Lookups\DataTransferObjects;

use App\Helpers\ArrayExtended;
use App\Helpers\DateTimeExtended;
use App\Helpers\StorageExtended;
use App\Http\Responses\IJSONResponse;
use WebApi\Database\Models\VehicleSpecification;

class VehicleSpecificationDTO implements IJSONResponse
{
    public int $id;
    public int $vehicle_specification_category_id;
    public VehicleSpecificationCategoryDTO $vehicle_specification_category;
    public string $name;
    public string $short_code;
    public string $short_description;
    public string $primary_logo_path;
    public string $primary_image_path;
    public int $is_active;
    public int $is_archived;
    public string $created_at;
    public string $updated_at;

    public function __construct(
        int $id,
        int $vehicle_specification_category_id,
        VehicleSpecificationCategoryDTO $vehicle_specification_category,
        string $name,
        string $short_code,
        string $short_description,
        string $primary_logo_path,
        string $primary_image_path,
        int $is_active,
        int $is_archived,
        string $created_at,
        string $updated_at        
    ) {
        $this->id = $id;
        $this->vehicle_specification_category_id = $vehicle_specification_category_id;
        $this->vehicle_specification_category = $vehicle_specification_category;
        $this->name = $name;
        $this->short_code = $short_code;
        $this->short_description = $short_description;
        $this->primary_logo_path = $primary_logo_path;
        $this->primary_image_path = $primary_image_path;
        $this->is_active = $is_active;
        $this->is_archived = $is_archived;
        $this->created_at = $created_at;
        $this->updated_at = $updated_at;
    }

    public static function fromDBModel(VehicleSpecification $model): self
    {
        $primary_logo_path = StorageExtended::getUrl($model->primary_logo_path);
        $primary_image_path = StorageExtended::getUrl($model->primary_image_path);
        $created_at = isset($model->created_at) && $model->created_at != null ? DateTimeExtended::toString($model->created_at) : null;
        $updated_at = isset($model->updated_at) && $model->updated_at != null ? DateTimeExtended::toString($model->updated_at) : null;
        $vehicle_specification_category_dto = isset($model->vehicle_specification_category) && $model->vehicle_specification_category != null ? VehicleSpecificationCategoryDTO::fromDBModel($model->vehicle_specification_category) : null;
        return new self(
            $model->id,
            $model->vehicle_specification_category_id,
            $vehicle_specification_category_dto,
            $model->name,
            $model->short_code,
            $model->short_description,
            $primary_logo_path,
            $primary_image_path,
            $model->is_active,
            $model->is_archived,
            $created_at,
            $updated_at
        );
    }

    public function toJSONResponse(): array
    {
        return ArrayExtended::filterNulls([
            'id' => $this->id,
            'vehicle_specification_category_id' => $this->vehicle_specification_category_id,
            'vehicle_specification_category' => $this->vehicle_specification_category,
            'name' => $this->name,
            'short_code' => $this->short_code,
            'short_description' => $this->short_description,
            'primary_logo_path' => $this->primary_logo_path,
            'primary_image_path' => $this->primary_image_path,
            'is_active' => $this->is_active,
            'is_archived' => $this->is_archived,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ]);
    }
}