<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehicleBodyTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicle_body_types', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->string("short_code", 32)->nullable();
            $table->string("short_description", 1024)->nullable();
            $table->string("primary_logo_path", 1024)->nullable();
            $table->string("primary_image_path", 1024)->nullable();
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
        Schema::dropIfExists('vehicle_body_types');
    }
}
