<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSklapalicaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sklapalica', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->unsignedInteger('idpuzle')->nullable();
            $table->unsignedInteger('idart')->nullable();
            $table->double('kolicina');
        });

        Schema::table('sklapalica',function (Blueprint $table){
            $table->foreign('idpuzle')->references('id')->on('puzzle')->onDelete('set null');
            $table->foreign('idart')->references('id')->on('artikli')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sklapalica');
    }
}
