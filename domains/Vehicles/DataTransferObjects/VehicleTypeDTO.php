<?php

namespace Vehicles\DataTransferObjects;

use App\Helpers\ArrayExtended;
use App\Helpers\DateTimeExtended;
use App\Helpers\StorageExtended;
use App\Http\Responses\IJSONResponse;
use WebApi\Database\Models\VehicleType;

class VehicleTypeDTO implements IJSONResponse
{
    public int $id;
    public int $vehicle_make_id;
    public int $vehicle_model_id;
    public int $vehicle_transmission_id;
    public int $vehicle_fuel_type_id;
    public int $vehicle_body_type_id;
    public int $vehicle_specification_category_id;
    public int $vehicle_specification_id;
    public VehicleMakeDTO $vehicle_make;
    public VehicleModelDTO $vehicle_model;
    public VehicleTransmissionDTO $vehicle_transmission;
    public VehicleFuelTypeDTO $vehicle_fuel_type;
    public VehicleBodyTypeDTO $vehicle_body_type;
    public VehicleSpecificationCategoryDTO $vehicle_specification_category;
    public VehicleSpecification $vehicle_specification;
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
        int $vehicle_make_id,
        int $vehicle_model_id,
        int $vehicle_transmission_id,
        int $vehicle_fuel_type_id,
        int $vehicle_body_type_id,
        int $vehicle_specification_category_id,
        int $vehicle_specification_id,
        VehicleMakeDTO $vehicle_make,
        VehicleModelDTO $vehicle_model,
        VehicleTransmissionDTO $vehicle_transmission,
        VehicleFuelTypeDTO $vehicle_fuel_type,
        VehicleBodyTypeDTO $vehicle_body_type,
        VehicleSpecificationCategoryDTO $vehicle_specification_category,
        VehicleSpecificationDTO $vehicle_specification,
        string $name,
        string $short_code,
        string $short_description,
        string $description,
        int $default_engine_cylinders,
        int $default_wheel_count,
        int $default_wheel_drive,
        float $default_engine_capacity,
        int $default_gears,
        float $default_co2_emission,
        float $default_engine_euro_std,
        float $default_fuel_consumption_mpg,
        float $default_fuel_consumption_mpg_extra_urban,
        float $default_fuel_consumption_mpg_urban_cold,
        float $default_acceleration,
        float $default_bhp,
        float $default_maximum_speed_miles,
        float $default_maximum_speed_kms,
        float $default_gross_weight,
        int $default_doors,
        int $default_seats,
        int $vehicles_added,
        int $vehicles_active,
        int $vehicles_sold,
        int $vehicles_financed,
        int $vehicles_discarded,
        string $primary_logo_path,
        string $primary_image_path,
        int $is_active,
        int $is_archived,
        string $created_at,
        string $updated_at        
    ) {
        $this->id = $id;
        $this->vehicle_make_id = $vehicle_make_id;
        $this->vehicle_model_id = $vehicle_model_id;
        $this->vehicle_transmission_id = $vehicle_transmission_id;
        $this->vehicle_fuel_type_id = $vehicle_fuel_type_id;
        $this->vehicle_body_type_id = $vehicle_body_type_id;
        $this->vehicle_specification_category_id = $vehicle_specification_category_id;
        $this->vehicle_specification_id = $vehicle_specification_id;
        $this->vehicle_make = $vehicle_make;
        $this->vehicle_model = $vehicle_model;
        $this->vehicle_transmission = $vehicle_transmission;
        $this->vehicle_fuel_type = $vehicle_fuel_type;
        $this->vehicle_body_type = $vehicle_body_type;
        $this->vehicle_specification_category = $vehicle_specification_category;
        $this->vehicle_specification = $vehicle_specification;
        $this->name = $name;
        $this->short_code = $short_code;
        $this->short_description = $short_description;
        $this->description = $description;
        $this->default_engine_cylinders = $default_engine_cylinders;
        $this->default_wheel_count = $default_wheel_count;
        $this->default_wheel_drive = $default_wheel_drive;
        $this->default_engine_capacity = $default_engine_capacity;
        $this->default_gears = $default_gears;
        $this->default_co2_emission = $default_co2_emission;
        $this->default_engine_euro_std = $default_engine_euro_std;
        $this->default_fuel_consumption_mpg = $default_fuel_consumption_mpg;
        $this->default_fuel_consumption_mpg_extra_urban = $default_fuel_consumption_mpg_extra_urban;
        $this->default_fuel_consumption_mpg_urban_cold = $default_fuel_consumption_mpg_urban_cold;
        $this->default_acceleration = $default_acceleration;
        $this->default_bhp = $default_bhp;
        $this->default_maximum_speed_miles = $default_maximum_speed_miles;
        $this->default_maximum_speed_kms = $default_maximum_speed_kms;
        $this->default_gross_weight = $default_gross_weight;
        $this->default_doors = $default_doors;
        $this->default_seats = $default_seats;
        $this->vehicles_added = $vehicles_added;
        $this->vehicles_active = $vehicles_active;
        $this->vehicles_sold = $vehicles_sold;
        $this->vehicles_financed = $vehicles_financed;
        $this->vehicles_discarded = $vehicles_discarded;
        $this->primary_logo_path = $primary_logo_path;
        $this->primary_image_path = $primary_image_path;
        $this->is_active = $is_active;
        $this->is_archived = $is_archived;
        $this->created_at = $created_at;
        $this->updated_at = $updated_at;
    }

    public static function fromDBModel(VehicleType $model): self
    {
        $primary_logo_path = StorageExtended::getUrl($model->primary_logo_path);
        $primary_image_path = StorageExtended::getUrl($model->primary_image_path);
        $created_at = isset($model->created_at) && $model->created_at != null ? DateTimeExtended::toString($model->created_at) : null;
        $updated_at = isset($model->updated_at) && $model->updated_at != null ? DateTimeExtended::toString($model->updated_at) : null;
        $vehicle_make_dto = isset($model->vehicle_make) && $model->vehicle_make != null ? VehicleMakeDTO::fromDBModel($model->vehicle_make) : null;
        $vehicle_model_dto = isset($model->vehicle_model) && $model->vehicle_model != null ? VehicleModelDTO::fromDBModel($model->vehicle_model) : null;
        $vehicle_transmission_dto = isset($model->vehicle_transmission) && $model->vehicle_transmission != null ? VehicleTransmissionDTO::fromDBModel($model->vehicle_transmission) : null;
        $vehicle_fuel_type_dto = isset($model->vehicle_fuel_type) && $model->vehicle_fuel_type != null ? VehicleFuelTypeDTO::fromDBModel($model->vehicle_fuel_type) : null;
        $vehicle_body_type_dto = isset($model->vehicle_body_type) && $model->vehicle_body_type != null ? VehicleBodyTypeDTO::fromDBModel($model->vehicle_body_type) : null;
        $vehicle_specification_category_dto = isset($model->vehicle_specification_category) && $model->vehicle_specification_category != null ? VehicleSpecificationCategoryDTO::fromDBModel($model->vehicle_specification_category) : null;
        $vehicle_specification_dto = isset($model->vehicle_specification) && $model->vehicle_specification != null ? VehicleSpecificationDTO::fromDBModel($model->vehicle_specification) : null;
        return new self(
            $model->id,
            $model->vehicle_make_id,
            $model->vehicle_model_id,
            $model->vehicle_transmission_id,
            $model->vehicle_fuel_type_id,
            $model->vehicle_body_type_id,
            $model->vehicle_specification_category_id,
            $model->vehicle_specification_id,
            $vehicle_make_dto,
            $vehicle_model_dto,
            $vehicle_transmission_dto,
            $vehicle_fuel_type_dto,
            $vehicle_body_type_dto,
            $vehicle_specification_category_dto,
            $vehicle_specification_dto,
            $model->name,
            $model->short_code,
            $model->short_description,
            $model->description,
            $model->default_engine_cylinders,
            $model->default_wheel_count,
            $model->default_wheel_drive,
            $model->default_engine_capacity,
            $model->default_gears,
            $model->default_co2_emission,
            $model->default_engine_euro_std,
            $model->default_fuel_consumption_mpg,
            $model->default_fuel_consumption_mpg_extra_urban,
            $model->default_fuel_consumption_mpg_urban_cold,
            $model->default_acceleration,
            $model->default_bhp,
            $model->default_maximum_speed_miles,
            $model->default_maximum_speed_kms,
            $model->default_gross_weight,
            $model->default_doors,
            $model->default_seats,
            $model->vehicles_added,
            $model->vehicles_active,
            $model->vehicles_sold,
            $model->vehicles_financed,
            $model->vehicles_discarded,
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
            'vehicle_model_id' => $this->vehicle_model_id,
            'vehicle_transmission_id' => $this->vehicle_transmission_id,
            'vehicle_fuel_type_id' => $this->vehicle_fuel_type_id,
            'vehicle_body_type_id' => $this->vehicle_body_type_id,
            'vehicle_specification_category_id' => $this->vehicle_specification_category_id,
            'vehicle_specification_id' => $this->vehicle_specification_id,
            'vehicle_make' => $this->vehicle_make,
            'vehicle_model' => $this->vehicle_model,
            'vehicle_transmission' => $this->vehicle_transmission,
            'vehicle_fuel_type' => $this->vehicle_fuel_type,
            'vehicle_body_type' => $this->vehicle_body_type,
            'vehicle_specification_category' => $this->vehicle_specification_category,
            'vehicle_specification' => $this->vehicle_specification,
            'name' => $this->name,
            'short_code' => $this->short_code,
            'short_description' => $this->short_description,
            'description' => $this->description,
            'default_engine_cylinders' => $this->default_engine_cylinders,
            'default_wheel_count' => $this->default_wheel_count,
            'default_wheel_drive' => $this->default_wheel_drive,
            'default_engine_capacity' => $this->default_engine_capacity,
            'default_gears' => $this->default_gears,
            'default_co2_emission' => $this->default_co2_emission,
            'default_engine_euro_std' => $this->default_engine_euro_std,
            'default_fuel_consumption_mpg' => $this->default_fuel_consumption_mpg,
            'default_fuel_consumption_mpg_extra_urban' => $this->default_fuel_consumption_mpg_extra_urban,
            'default_fuel_consumption_mpg_urban_cold' => $this->default_fuel_consumption_mpg_urban_cold,
            'default_acceleration' => $this->default_acceleration,
            'default_bhp' => $this->default_bhp,
            'default_maximum_speed_miles' => $this->default_maximum_speed_miles,
            'default_maximum_speed_kms' => $this->default_maximum_speed_kms,
            'default_gross_weight' => $this->default_gross_weight,
            'default_doors' => $this->default_doors,
            'default_seats' => $this->default_seats,
            'vehicles_added' => $this->vehicles_added,
            'vehicles_active' => $this->vehicles_active,
            'vehicles_sold' => $this->vehicles_sold,
            'vehicles_financed' => $this->vehicles_financed,
            'vehicles_discarded' => $this->vehicles_discarded,
            'primary_logo_path' => $this->primary_logo_path,
            'primary_image_path' => $this->primary_image_path,
            'is_active' => $this->is_active,
            'is_archived' => $this->is_archived,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ]);
    }
}