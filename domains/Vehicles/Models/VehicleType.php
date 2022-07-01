<?php

namespace Vehicles\Models;

use App\Models\BaseModel;

class VehicleType extends BaseModel
{
    protected $fillable = ['vehicle_make_id', 'vehicle_model_id', 'vehicle_transmission_id', 'vehicle_fuel_type_id',
        'vehicle_specification_category_id', 'vehicle_specification_id', 'name', 'short_code', 'short_description',
        'description', 'default_engine_cylinders', 'default_wheel_count', 'default_wheel_drive', 'default_engine_capacity',
        'default_gears', 'default_co2_emission', 'default_engine_euro_std', 'default_fuel_consumption_mpg',
        'default_fuel_consumption_mpg_extra_urban', 'default_fuel_consumption_mpg_urban_cold', 'default_acceleration',
        'default_bhp', 'default_maximum_speed_miles', 'default_maximum_speed_kms', 'default_gross_weight', 'default_doors',
        'default_seats', 'primary_logo_path', 'primary_image_path', 'vehicles_added', 'vehicles_active', 'vehicles_sold',
        'vehicles_financed', 'vehicles_discarded', 'is_active', 'is_archived', 'created_at', 'updated_at'];
    protected $table = "vehicle_types";
}