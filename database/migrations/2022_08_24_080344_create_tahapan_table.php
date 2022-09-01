<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTahapanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tahapan', function (Blueprint $table) {
            $table->id();
            $table->integer('urutan')->uniqe();
            $table->string('nama_tahapan')->uniqe();
            $table->string('kode')->uniqe();
            $table->char('created_by', 3)->nullable();
            $table->char('updated_by', 3)->nullable();
            $table->timestamps();
        });
        Schema::create('data', function (Blueprint $table) {
            $table->id();
            $table->string('id_bs');
            $table->integer('nu_rt');
            $table->string('kode');
            $table->string('pencacah');
            $table->string('file');
            $table->char('created_by', 3)->nullable();
            $table->char('updated_by', 3)->nullable();
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
        Schema::dropIfExists('tahapan');
        Schema::dropIfExists('data');
    }
}
