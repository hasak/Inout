<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJediniceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jedinice', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string("ime");
            $table->string("skracenica");
            $table->unsignedinteger("user")->nullable();
            $table->double("steps")->default(1);
        });

        Schema::table('jedinice', function (Blueprint $table) {
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
        Schema::dropIfExists('jedinice');
    }
}
