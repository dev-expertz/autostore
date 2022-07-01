<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehicleTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicle_types', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("vehicle_make_id");
            $table->foreign("vehicle_make_id", "vehicle_types_vehicle_make_id_foreign")->references('id')->on("vehicle_makes");
            $table->unsignedBigInteger("vehicle_model_id");
            $table->foreign("vehicle_model_id", "vehicle_types_vehicle_model_id_foreign")->references('id')->on("vehicle_models");
            $table->unsignedBigInteger("vehicle_transmission_id");
            $table->foreign("vehicle_transmission_id", "vehicle_types_vehicle_transmission_id_foreign")->references('id')->on("vehicle_transmissions");
            $table->unsignedBigInteger("vehicle_fuel_type_id");
            $table->foreign("vehicle_fuel_type_id", "vehicle_types_vehicle_fuel_type_id_foreign")->references('id')->on("vehicle_fuel_types");
            $table->unsignedBigInteger("vehicle_specification_category_id");
            $table->foreign("vehicle_specification_category_id", "vehicle_types_vehicle_specification_category_id_foreign")->references('id')->on("vehicle_specification_categories");
            $table->unsignedBigInteger("vehicle_specification_id");
            $table->foreign("vehicle_specification_id", "vehicle_types_vehicle_specification_id_foreign")->references('id')->on("vehicle_specifications");
            $table->string("name");
            $table->string("short_code", 32)->nullable();
            $table->string("short_description", 1024)->nullable();
            $table->text("description")->nullable();
            $table->unsignedInteger("default_engine_cylinders")->nullable();
            $table->unsignedInteger("default_wheel_count")->nullable();
            $table->unsignedInteger("default_wheel_drive")->nullable();
            $table->unsignedDecimal("default_engine_capacity")->nullable();
            $table->unsignedInteger("default_gears")->nullable();
            $table->unsignedDecimal("default_co2_emission")->nullable();
            $table->unsignedDecimal("default_engine_euro_std")->nullable();
            $table->unsignedDecimal("default_fuel_consumption_mpg")->nullable();
            $table->unsignedDecimal("default_fuel_consumption_mpg_extra_urban")->nullable();
            $table->unsignedDecimal("default_fuel_consumption_mpg_urban_cold")->nullable();
            $table->unsignedDecimal("default_acceleration")->nullable();
            $table->unsignedDecimal("default_bhp")->nullable();
            $table->unsignedDecimal("default_maximum_speed_miles")->nullable();
            $table->unsignedDecimal("default_maximum_speed_kms")->nullable();
            $table->unsignedDecimal("default_gross_weight")->nullable();
            $table->unsignedInteger("default_doors")->nullable();
            $table->unsignedInteger("default_seats")->nullable();
            $table->string("primary_logo_path", 1024)->nullable();
            $table->string("primary_image_path", 1024)->nullable();
            $table->unsignedBigInteger("vehicles_added")->nullable()->default(0);
            $table->unsignedBigInteger("vehicles_active")->nullable()->default(0);
            $table->unsignedBigInteger("vehicles_sold")->nullable()->default(0);
            $table->unsignedBigInteger("vehicles_financed")->nullable()->default(0);
            $table->unsignedBigInteger("vehicles_discarded")->nullable()->default(0);
            $table->tinyInteger("is_active")->default(1);
            $table->tinyInteger("is_archived")->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vehicle_types');
    }
}
