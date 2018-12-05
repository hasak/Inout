<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePuzzleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('puzzle', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('ime');
            $table->unsignedInteger('user')->nullable();
            $table->double('cijena');
        });

        Schema::table('puzzle',function (Blueprint $table){
            $table->foreign('user')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('puzzle');
    }
}
