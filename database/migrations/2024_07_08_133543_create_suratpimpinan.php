<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuratpimpinan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('suratpimpinan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('submission_id');
            $table->foreign('submission_id')->references('id')->on('submissions')->onDelete('cascade');
            $table->binary('file_pimpinan');
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
        Schema::dropIfExists('suratpimpinan');
    }
}
