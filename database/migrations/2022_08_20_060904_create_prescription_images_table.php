<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrescriptionImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prescription_images', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('prescription_id');
            $table->foreign('prescription_id')->references('id')->on('prescriptions')->onUpdate('cascade')->onDelete('cascade');
            $table->text('url')->nullable();
            $table->integer('status')->nullable();
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
        Schema::dropIfExists('prescription_images');
    }
}
