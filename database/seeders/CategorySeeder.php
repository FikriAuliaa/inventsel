<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::create([
            'name' => 'Elektronik',
            'description' => 'Perangkat elektronik, komputer, dan aksesoris IT',
        ]);

        Category::create([
            'name' => 'Furnitur',
            'description' => 'Meja, kursi, lemari, dan perabotan kantor',
        ]);

        Category::create([
            'name' => 'ATK',
            'description' => 'Alat Tulis Kantor',
        ]);
    }
}