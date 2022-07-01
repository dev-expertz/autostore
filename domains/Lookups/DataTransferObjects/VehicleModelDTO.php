<?php

namespace Lookups\DataTransferObjects;

use App\Helpers\ArrayExtended;
use App\Helpers\DateTimeExtended;
use App\Helpers\StorageExtended;
use App\Helpers\StrExtended;
use App\Http\Responses\IJSONResponse;
use WebApi\Database\Models\VehicleModel;

class VehicleModelDTO implements IJSONResponse
{
    public int $id;
    public int $vehicle_make_id;
    public VehicleMakeDTO $vehicle_make;
    public string $name;
    public string $short_code;
    public string $short_description;
    public array $year_ranges;
    public string $primary_logo_path;
    public string $primary_image_path;
    public int $is_active;
    public int $is_archived;
    public string $created_at;
    public string $updated_at;

    public function __construct(
        int $id,
        int $vehicle_make_id,
        VehicleMakeDTO $vehicle_make,
        string $name,
        string $short_code,
        string $short_description,
        array $year_ranges,
        string $primary_logo_path,
        string $primary_image_path,
        int $is_active,
        int $is_archived,
        string $created_at,
        string $updated_at        
    ) {
        $this->id = $id;
        $this->vehicle_make_id = $vehicle_make_id;
        $this->vehicle_make = $vehicle_make;
        $this->name = $name;
        $this->short_code = $short_code;
        $this->short_description = $short_description;
        $this->year_ranges = $year_ranges;
        $this->primary_logo_path = $primary_logo_path;
        $this->primary_image_path = $primary_image_path;
        $this->is_active = $is_active;
        $this->is_archived = $is_archived;
        $this->created_at = $created_at;
        $this->updated_at = $updated_at;
    }

    public static function fromDBModel(VehicleModel $model): self
    {
        $year_ranges = isset($model->year_ranges) && !StrExtended::isEmpty($model->year_ranges) ? json_decode($model->year_ranges) : [];
        $primary_logo_path = StorageExtended::getUrl($model->primary_logo_path);
        $primary_image_path = StorageExtended::getUrl($model->primary_image_path);
        $created_at = isset($model->created_at) && $model->created_at != null ? DateTimeExtended::toString($model->created_at) : null;
        $updated_at = isset($model->updated_at) && $model->updated_at != null ? DateTimeExtended::toString($model->updated_at) : null;
        $vehicle_make_dto = isset($model->vehicle_make) && $model->vehicle_make != null ? VehicleMakeDTO::fromDBModel($model->vehicle_make) : null;
        return new self(
            $model->id,
            $model->vehicle_make_id,
            $vehicle_make_dto,
            $model->name,
            $model->short_code,
            $model->short_description,
            $year_ranges,
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
            'vehicle_make_id' => $this->vehicle_make_id,
            'vehicle_make' => $this->vehicle_make,
            'name' => $this->name,
            'short_code' => $this->short_code,
            'short_description' => $this->short_description,
            'year_ranges' => $this->year_ranges,
            'primary_logo_path' => $this->primary_logo_path,
            'primary_image_path' => $this->primary_image_path,
            'is_active' => $this->is_active,
            'is_archived' => $this->is_archived,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ]);
    }
}