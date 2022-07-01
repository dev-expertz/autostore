<?php

namespace Lookups\Models;

class VehicleSpecificationCategory extends LookupsBaseModel
{
    protected $fillable = ['name', 'short_code', 'short_description', 'primary_logo_path', 'primary_image_path', 'is_active', 'is_archived', 'created_at', 'updated_at'];
    protected $table = "vehicle_specification_categories";
}