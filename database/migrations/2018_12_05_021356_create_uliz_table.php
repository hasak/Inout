<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUlizTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //Schema::enableForeignKeyConstraints();
        Schema::create('uliz', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->date("datumunosa");
            $table->unsignedInteger("artikal")->nullable();
            $table->double("kolicina");
            $table->double("cijena");
			$table->unsignedInteger("puzla")->nullable();
			$table->unsignedInteger("dobavljac")->nullable();
			$table->text("opis")->nullable();
            $table->unsignedInteger("user")->nullable();
        });

        Schema::table('uliz', function (Blueprint $table) {
            $table->foreign("artikal")->references("id")->on("artikli")->onDelete('set null');
            $table->foreign("user")->references("id")->on("users")->onDelete('set null');
			$table->foreign("puzla")->references("id")->on("puzzle")->onDelete('set null');
			$table->foreign("dobavljac")->references("id")->on("dobavljaci")->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('uliz');
    }
}
