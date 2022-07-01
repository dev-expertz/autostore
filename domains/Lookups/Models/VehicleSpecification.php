<?php

namespace Lookups\Models;

class VehicleSpecification extends LookupsBaseModel
{
    protected $fillable = ['vehicle_specification_category_id', 'name', 'short_code', 'short_description', 'primary_logo_path', 'primary_image_path', 'is_active', 'is_archived', 'created_at', 'updated_at'];
    protected $table = "vehicle_specifications";
}