<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCiudadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('ciudads', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 50)->nullable()->default(null);
            $table->foreignId('pais_id')->nullable()->constrained('pais')->cascadeOnDelete()->cascadeOnUpdate()->default(null);
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
        Schema::dropIfExists('ciudads');
    }
}
