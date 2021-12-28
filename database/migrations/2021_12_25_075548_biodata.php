<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Biodata extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('biodata',function(Blueprint $table){
            $table->id();
            $table->foreignId('user_id')
                ->nullable()
                ->constrained()
                ->on('users');
            $table->string('tempat_lahir')->nullable();
            $table->date('tanggal_lahir');
            $table->string('instansi');
            $table->string('alamat')->nullable();
            $table->string('no_telp')->nullable();
            $table->string('foto_closeup')->nullable();
            $table->string('foto_body')->nullable();
            $table->string('cv')->nullable();
            $table->string('karya_tulis')->nullable();
            $table->timestampsTz();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('biodata');
    }
}
