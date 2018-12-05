<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArtikliTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('artikli', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string("ime");
            $table->unsignedInteger("jedmj")->nullable();
            $table->unsignedInteger("user")->nullable();
        });

        Schema::table('artikli', function (Blueprint $table) {
            $table->foreign("jedmj")->references("id")->on("jedinice")->onDelete('set null');
            $table->foreign("user")->references("id")->on("users")->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('artikli');
    }
}
