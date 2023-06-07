<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dtpasien', function (Blueprint $table) {
            $table->id();
            $table->string('Nomor_Rm');
            $table->string('Nama_Lengkap');
            $table->string('Jenis_Identitas');
            $table->string('Nomor_Identitas');
            $table->string('Gender');
            $table->string('Agama');
            $table->string('Alamat');
            $table->string('Nomor_Hp');
            $table->string('Jaminan_Kesehatan');
            $table->string('Nomor_Jamkes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dtpasien');
    }
};
