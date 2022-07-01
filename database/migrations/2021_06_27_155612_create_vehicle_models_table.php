<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehicleModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicle_models', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("vehicle_make_id");
            $table->foreign("vehicle_make_id", "vehicle_models_vehicle_make_id_foreign")->references('id')->on("vehicle_makes");
            $table->string("name");
            $table->string("short_code", 32)->nullable();
            $table->string("short_description", 1024)->nullable();
            $table->string("year_ranges", 2048)->nullable();
            $table->string("primary_logo_path", 1024)->nullable();
            $table->string("primary_image_path", 1024)->nullable();
            $table->unsignedTinyInteger("is_active")->default(1);
            $table->unsignedTinyInteger("is_archived")->default(0);
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
        Schema::dropIfExists('vehicle_models');
    }
}
