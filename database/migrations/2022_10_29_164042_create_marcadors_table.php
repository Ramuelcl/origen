<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMarcadorsTable extends Migration
{
    protected $table = 'marcadores';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();

        Schema::create($this->table, function (Blueprint $table) {
            $table->id();
            $table
                ->string('nombre', 45)
                ->nullable()
                ->default(null)
                ->unique()
                ->charset('utf8');
            $table
                ->string('babosa', 45)
                ->nullable()
                ->default(null)
                ->charset('utf8');
            $table
                ->string('hexa', 7)
                ->unique()
                ->default('#')
                ->charset('utf8');
            $table
                ->string('imagen', 128)
                ->nullable()
                ->default(null)
                ->charset('utf8');
            $table
                ->string('rgb', 20)
                ->nullable()
                ->default(null)
                ->charset('utf8');
            $table->json('metadata')->nullable();
            $table
                ->boolean('activo')
                ->nullable()
                ->default(true);
            $table->softDeletes();
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
        Schema::dropIfExists($this->table);
    }
}
