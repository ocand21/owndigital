<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKonfigWebsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('konfig_web', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nama_website');
            $table->string('deskripsi');
            $table->string('alamat');
            $table->string('email');
            $table->string('url_web');
            $table->string('whatsapp');
            $table->string('telegram');
            $table->string('instagram')->nullable();
            $table->string('facebook')->nullable();
            $table->string('twitter')->nullable();
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
        Schema::dropIfExists('konfig_web');
    }
}
