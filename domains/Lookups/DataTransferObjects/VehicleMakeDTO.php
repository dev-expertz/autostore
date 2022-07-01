<?php

namespace Lookups\DataTransferObjects;

use App\Helpers\ArrayExtended;
use App\Helpers\DateTimeExtended;
use App\Helpers\StorageExtended;
use App\Helpers\StrExtended;
use App\Http\Responses\IJSONResponse;
use Lookups\Requests\VehicleMakeItemRequest;
use Lookups\Models\VehicleMake;

class VehicleMakeDTO implements IJSONResponse
{
    public ?int $id;
    public string $name;
    public string $short_code;
    public ?string $short_description;
    public ?array $year_ranges;
    public ?string $primary_logo_path;
    public ?string $primary_image_path;
    public ?int $is_active;
    public ?int $is_archived;
    public ?array $images;
    public ?string $created_at;
    public ?string $updated_at;

    public function __construct(
        ?int $id,
        string $name,
        string $short_code,
        ?string $short_description,
        ?array $year_ranges,
        ?string $primary_logo_path,
        ?string $primary_image_path,
        ?int $is_active,
        ?int $is_archived,
        ?array $images,
        ?string $created_at,
        ?string $updated_at        
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->short_code = $short_code;
        $this->short_description = $short_description;
        $this->year_ranges = $year_ranges;
        $this->primary_logo_path = $primary_logo_path;
        $this->primary_image_path = $primary_image_path;
        $this->is_active = $is_active;
        $this->is_archived = $is_archived;
        $this->images = $images;
        $this->created_at = $created_at;
        $this->updated_at = $updated_at;
    }

    public static function fromDBModel(VehicleMake $model): self
    {
        $year_ranges = isset($model->year_ranges) && !StrExtended::isEmpty($model->year_ranges) ? json_decode($model->year_ranges) : [];
        $primary_logo_path = StorageExtended::getUrl($model->primary_logo_path);
        $primary_image_path = StorageExtended::getUrl($model->primary_image_path);
        $created_at = isset($model->created_at) && $model->created_at != null ? DateTimeExtended::toString($model->created_at) : null;
        $updated_at = isset($model->updated_at) && $model->updated_at != null ? DateTimeExtended::toString($model->updated_at) : null;
        return new self(
            $model->id,
            $model->name,
            $model->short_code,
            $model->short_description,
            $year_ranges,
            $primary_logo_path,
            $primary_image_path,
            $model->is_active,
            $model->is_archived,
            [],
            $created_at,
            $updated_at
        );
    }

    /**
     * @return VehicleMakeDTO
     */
    public static function fromStoreRequest(VehicleMakeItemRequest $request): VehicleMakeDTO
    {
        $id = $request->filled("id") ? (int) $request->get('id') : null;
        $name = $request->get('name');
        $short_code = $request->get('short_code');
        $short_description = $request->get('short_description');
        $year_ranges = $request->filled("year_ranges") ? (array) $request->get('year_ranges') : [];
        $primary_logo_path = $request->get('primary_logo_path');
        $primary_image_path = $request->get('primary_image_path');
        $is_active = $request->filled("is_active") ? (int) $request->get('is_active') : 1;
        $is_archived = $request->filled("is_archived") ? (int) $request->get('is_archived') : 0;
        $images = [];
        $created_at = $request->get('created_at');
        $updated_at = $request->get('updated_at');
        if(isset($request->files) && $request->files != null && count($request->files) > 0)
        {
            foreach($request->files AS $file)
            {
                $images[] = $file;
            }
        }

        return new self($id, $name, $short_code, $short_description, $year_ranges, $primary_logo_path, $primary_image_path, $is_active, $is_archived, $images, $created_at, $updated_at);
    }

    public function toJSONResponse(): array
    {
        return ArrayExtended::filterNulls([
            'id' => isset($this->id) && $this->id > 0 ? $this->id : null,
            'name' => $this->name,
            'short_code' => $this->short_code,
            'short_description' => $this->short_description,
            'year_ranges' => json_encode($this->year_ranges),
            'primary_logo_path' => $this->primary_logo_path,
            'primary_image_path' => $this->primary_image_path,
            'is_active' => $this->is_active,
            'is_archived' => $this->is_archived,
            'images' => $this->images,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ]);
    }

    public function toModelData(): array
    {
        return ArrayExtended::filterNulls([
            'id' => isset($this->id) && $this->id > 0 ? $this->id : null,
            'name' => $this->name,
            'short_code' => $this->short_code,
            'short_description' => $this->short_description,
            'year_ranges' => json_encode($this->year_ranges),
            'primary_logo_path' => $this->primary_logo_path,
            'primary_image_path' => $this->primary_image_path,
            'is_active' => $this->is_active,
            'is_archived' => $this->is_archived,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ]);
    }
}