<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubmissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('submissions', function (Blueprint $table) {
            $table->id(); // Kunci utama baru untuk tabel submissions
            $table->string('sk_file')->nullable();
            $table->foreignId('user_id')->unique()->constrained(); // Kunci asing ke tabel users, diatur sebagai unik
            $table->string('nik')->unique();
            $table->string('name', 100);
            $table->string('kelurahan_name');
            $table->text('address');
            $table->text('ibadah');
            $table->string('bank_name')->nullable();
            $table->string('phone');
            $table->string('email')->unique();
            $table->string('budget');
            $table->string('bank_account');
            $table->binary('application_letter');
            $table->binary('documentation');
            $table->binary('land_certificate');
            $table->string('management_letter')->nullable();
            $table->string('notaris')->nullable();
            $table->binary('npwp');
            $table->binary('domicile_letter');
            $table->binary('tanah');
            $table->binary('rab');
            $table->enum('status', ['proses', 'disetujui', 'ditolak', 'diketahui','diterima','pencairan'])->default('proses');
            $table->text('note')->nullable();
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
        Schema::table('submissions', function (Blueprint $table) {
            $table->dropColumn('sk_file');
        });
    }
}
