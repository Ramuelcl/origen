<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEntidadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('entidads', function (Blueprint $table) {
            $table->id();
            $table->enum('tipo', ["perfil","cliente","proveedor","cli_pro"]);
            $table->string('razonSocial', 128);
            $table->string('nombres', 80);
            $table->string('apellidos', 80);
            $table->boolean('activo')->default(true);
            $table->string('eMail')->unique();
            $table->foreignId('direccion_id')->nullable()->constrained()->cascadeOnDelete()->cascadeOnUpdate()->default(null);
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
        Schema::dropIfExists('entidads');
    }
}
