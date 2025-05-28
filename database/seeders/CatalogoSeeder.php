<?php

namespace Database\Seeders;

use App\Models\Catalogo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CatalogoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Catalogo::create([
            'nombre' => 'principal'
        ]);
    }
}
