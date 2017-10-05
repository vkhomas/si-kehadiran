<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMahasiswaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mahasiswa', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('users_id');
            $table->integer('nim')->unique();
            $table->string('dosbing');
            $table->string('judul_riset');
            $table->integer('waktu_residensi');
            $table->decimal('rating_kehadiran',5,2)->default("0");
            $table->boolean('bimbingan')->default(false);
            $table->boolean('alumni')->default(false);
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
        Schema::dropIfExists('mahasiswa');
    }
}
