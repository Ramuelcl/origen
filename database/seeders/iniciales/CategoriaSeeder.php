<?php

namespace Database\Seeders;

use App\Models\backend\Categoria;
use Illuminate\Database\Seeder;

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Categoria::factory(10)->create();
    }
}
