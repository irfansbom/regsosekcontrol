<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenerimaanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::create('p_koseka', function (Blueprint $table) {
        //     $table->id();
        //     $table->string('id_sls', 15);
        //     $table->integer('copy')->default(1);
        //     $table->integer('status')->default(0);
        //     $table->string('no_surat', 50)->nullable();
        //     $table->string('no_box', 10)->nullable();
        //     $table->char('created_by', 3)->nullable();
        //     $table->char('updated_by', 3)->nullable();
        //     $table->timestamps();
        //     $table->unique(["id_sls", "copy"], 'sls_copy');
        // });
        Schema::dropIfExists('p_kabkot');
        Schema::dropIfExists('p_provinsi');
        Schema::create('p_kabkot', function (Blueprint $table) {
            $table->id();
            $table->string('id_sls', 15);
            $table->string('kues', 10);
            $table->integer('set')->default(1);
            $table->integer('status')->default(0);
            $table->string('no_surat', 50)->nullable();
            $table->string('no_box', 10)->nullable();
            $table->char('created_by', 3)->nullable();
            $table->char('updated_by', 3)->nullable();
            $table->timestamps();
            $table->unique(["id_sls", "kues", "set"], 'sls_kues_set');
        });
        Schema::create('p_provinsi', function (Blueprint $table) {
            $table->id();
            $table->string('id_sls', 15);
            $table->string('kues', 10);
            $table->integer('set')->default(1);
            $table->integer('status')->default(0);
            $table->string('no_surat', 50)->nullable();
            $table->string('no_box', 10)->nullable();
            $table->char('created_by', 3)->nullable();
            $table->char('updated_by', 3)->nullable();
            $table->timestamps();
            $table->unique(["id_sls", "kues", "set"], 'sls_kues_set');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    }
}
