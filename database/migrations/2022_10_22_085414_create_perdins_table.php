<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePerdinsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('perdins', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onUpdate('cascade') ->onDelete('cascade');
            $table->foreignId('kota_asal_id')->constrained('kotas')->onUpdate('cascade') ->onDelete('cascade');
            $table->foreignId('kota_tujuan_id')->constrained('kotas')->onUpdate('cascade') ->onDelete('cascade');
            $table->date('tgl_berangkat');
            $table->date('tgl_pulang');
            $table->integer('durasi');
            $table->integer('uangsaku');
            $table->string('deskripsi');
            $table->char('konfirmasi', 8);
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
        Schema::dropIfExists('perdins');
    }
}
