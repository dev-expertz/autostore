<?php

namespace Lookups\Models;

class VehicleModel extends LookupsBaseModel
{
    protected $fillable = ['vehicle_make_id', 'name', 'short_code', 'short_description', 'year_ranges', 'primary_logo_path', 'primary_image_path', 'is_active', 'is_archived', 'created_at', 'updated_at'];
    protected $table = "vehicle_models";

    public function vehicle_make() {
        return $this->belongsTo('WebApi\Database\Models\VehicleMake', 'vehicle_make_id');
    }
}