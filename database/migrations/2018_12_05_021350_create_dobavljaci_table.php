<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDobavljaciTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dobavljaci', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
			$table->string("ime");
			$table->string("opis")->nullable();
			$table->unsignedInteger("userid")->nullable();
        });
		Schema::table('dobavljaci', function (Blueprint $table) {
			$table->foreign("userid")->references("id")->on("users")->onDelete('set null');
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dobavljaci');
    }
}
