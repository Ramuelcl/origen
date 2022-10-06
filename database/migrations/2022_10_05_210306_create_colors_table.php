<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateColorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('colors', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 50)->nullable()->default(null)->unique();
            $table->string('slut', 50)->nullable()->default(null);
            $table->string('hexa', 6)->nullable()->unique();
            $table->string('rgb', 20)->nullable()->default(null);
            $table->json('metadata')->nullable()->default(null);
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('colors');
    }
}
