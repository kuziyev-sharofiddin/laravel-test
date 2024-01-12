<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Warehouse;

class WarehouseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Warehouse::create([
            'material_id' => 1,
            'remainder' => 12,
            'price' => 1500,
        ]);
        Warehouse::create([
            'material_id' => 1,
            'remainder' => 200,
            'price' => 1600,
        ]);
        Warehouse::create([
            'material_id' => 2,
            'remainder' => 40,
            'price' => 500,
        ]);
        Warehouse::create([
            'material_id' => 2,
            'remainder' => 300,
            'price' => 550,
        ]);
        Warehouse::create([
            'material_id' => 3,
            'remainder' => 500,
            'price' => 300,
        ]);
        Warehouse::create([
            'material_id' => 4,
            'remainder' => 1000,
            'price' => 2000,
        ]);
    }
}
