<?php

namespace Database\Seeders;

use App\Models\backend\Color;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Facades\DB;

class ColorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // echo asset('storage/file.txt');

        $filePath = 'public\sistema\imagenes';
        if (Storage::exists($filePath)) {
            Storage::deleteDirectory($filePath);
        }
        Storage::makeDirectory($filePath);

        Color::factory(1)->create();
    }
}
