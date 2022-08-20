<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuotationRowsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quotation_rows', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('quotation_id');
            $table->foreign('quotation_id')->references('id')->on('quotations')->onUpdate('cascade')->onDelete('cascade');
            $table->string('drug');
            $table->string('qtr');
            $table->double('amount');
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
        Schema::dropIfExists('quotation_rows');
    }
}
