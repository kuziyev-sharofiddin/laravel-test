<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Material;

class MaterialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Material::create([
            'material_name' =>'Mato',
        ]);
        Material::create([
            'material_name' =>'Ip',
        ]);
        Material::create([
            'material_name' =>'Tugma',
        ]);
        Material::create([
            'material_name' =>'Zamok',
        ]);
    }
}
