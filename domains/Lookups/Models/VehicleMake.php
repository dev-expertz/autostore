<?php

namespace Lookups\Models;

class VehicleMake extends LookupsBaseModel
{    
    protected $fillable = ['name', 'short_code', 'short_description', 'year_ranges', 'primary_logo_path', 'primary_image_path', 'is_active', 'is_archived', 'created_at', 'updated_at'];
    protected $table = "vehicle_makes";
}