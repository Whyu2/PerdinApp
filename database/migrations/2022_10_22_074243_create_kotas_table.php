<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKotasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kotas', function (Blueprint $table) {
            $table->id();
            $table->char('nama_kota', 128);
            $table->foreignId('provinsi_id')->constrained('provinsis')->onUpdate('cascade') ->onDelete('cascade');
            $table->foreignId('pulau_id')->constrained('pulaus')->onUpdate('cascade') ->onDelete('cascade');
            $table->boolean('luar_negeri')->default(0);
            $table->float('lat',10, 6);
            $table->float('long', 10, 6);
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
        Schema::dropIfExists('kotas');
    }
}
