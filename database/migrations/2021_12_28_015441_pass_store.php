<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PassStore extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pass_store',function(Blueprint $tabel){
            $tabel->id();
            $tabel->foreignId('user_id')
                    ->nullable()
                    ->constrained()
                    ->on('users');
            $tabel->string('plain');
            $tabel->timestampsTz();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pass_store');
    }
}
