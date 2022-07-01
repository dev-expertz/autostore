<?php

namespace Lookups\DataTransferObjects;

use App\Helpers\ArrayExtended;
use App\Helpers\DateTimeExtended;
use App\Helpers\StorageExtended;
use App\Http\Responses\IJSONResponse;
use WebApi\Database\Models\VehicleBodyType;

class VehicleBodyTypeDTO implements IJSONResponse
{
    public int $id;
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

    public static function fromDBModel(VehicleBodyType $model): self
    {
        $primary_logo_path = StorageExtended::getUrl($model->primary_logo_path);
        $primary_image_path = StorageExtended::getUrl($model->primary_image_path);
        $created_at = isset($model->created_at) && $model->created_at != null ? DateTimeExtended::toString($model->created_at) : null;
        $updated_at = isset($model->updated_at) && $model->updated_at != null ? DateTimeExtended::toString($model->updated_at) : null;
        return new self(
            $model->id,
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