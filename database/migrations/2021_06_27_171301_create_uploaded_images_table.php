<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUploadedImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('uploaded_images', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("user_id")->nullable();
            $table->foreign("user_id", "uploaded_images_user_id_foreign")->references('id')->on("users");
            $table->unsignedBigInteger("reference_item_id")->nullable();
            $table->unsignedBigInteger("reference_item_type_id")->nullable();
            $table->string("reference_item_type_code", 32)->nullable();
            $table->string("name")->nullable();
            $table->string("short_code", 32)->nullable();
            $table->string("short_description", 1024)->nullable();
            $table->string("image_path", 2048)->nullable();
            $table->unsignedInteger("image_sequence")->nullable();
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
        Schema::dropIfExists('uploaded_images');
    }
}
