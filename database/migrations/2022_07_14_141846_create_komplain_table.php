<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKomplainTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('komplain', function (Blueprint $table) {
            $table->bigIncrements('id_komplain');
            $table->text("keterangan");
            $table->text("foto");
            $table->string("kategori", 25);
            $table->string("status");
            $table->string("id_transaksi");
            $table->softDeletes();
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
        Schema::dropIfExists('komplain');
    }
}
