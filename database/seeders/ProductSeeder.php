<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::create([
            'product_name' =>"Ko'ylak",
            'product_code' => 124313131,
        ]);
        Product::create([
            'product_name' =>'Shim',
            'product_code' => 124313135,
        ]);
    }

    // public function getRequest(Request $request)
    // {
    //     $productMaterialsData = $request->json()->all();
    //     $productIds = array_column($productMaterialsData, 'product_id');
    //     $matchingProducts = Product::whereIn('id', $productIds)->get();
    //     $uniqueMaterialsHashMap = [];

    //     foreach ($matchingProducts as $index => $matchingProduct) {
    //         $productId = $matchingProduct->id;
    //         $productMaterials = ProductMaterial::where('product_id', $productId)->get();
    //         $matchingProduct->materials = $productMaterials->map(function ($item) use ($index, $productMaterialsData, &$uniqueMaterialsHashMap) {
    //             $uniqueMaterialsHashMap[$item->material_id] = true;
    //             $item->qty = $item->quantity * $productMaterialsData[$index]['qty'];
    //             return $item;
    //         });
    //     }

    //     $materialsIds = array_keys($uniqueMaterialsHashMap);
    //     $warehouses = Warehouse::whereIn('material_id', $materialsIds)->get();

    //     foreach ($matchingProducts as $matchingProduct) {
    //         $matchingProduct->product_materials = collect([]);
    //         foreach ($matchingProduct->materials as $material) {
    //             $qty = $material->qty;
    //             $materialWarehouses = $warehouses -> filter(function ($item) use ($material) {
    //                 return $item->material_id == $material->id;
    //             });
    //             while ($qty !== 0) {
    //                 foreach ($materialWarehouses as $index => $materialWarehouse) {
    //                     if ($materialWarehouse->remainder > $qty) {
    //                         $materialWarehouse->remainder -= $qty;
    //                         $qty = 0;
    //                         $materialWarehouse->qty = $qty;
    //                         $matchingProduct->product_materials->push($materialWarehouse);
    //                     } else if ($materialWarehouse->remainder < $qty) {
    //                         $materialWarehouse->remainder = 0;
    //                         $qty -= $materialWarehouse->remainder;
    //                         $materialWarehouse->qty = $materialWarehouse->remainder;
    //                         $matchingProduct->product_materials->push($materialWarehouse);
    //                     }
    //                 }

    //                 $matchingProduct->product_materials->push([
    //                     "id" => null,
    //                     "quantity" => $qty,
    //                     "material_id" => $material->id,
    //                     "price" => null
    //                 ]);
    //                 $qty = 0;
    //             }
    //         }

    //     }
    //     // $matchingProduct->materials = $matchingProduct->product_materials;

    //     return response()->json(['result' => $matchingProducts]);
    // } -->

}
