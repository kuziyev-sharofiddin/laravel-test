<?php

namespace App\Repository;

use App\Interface\BaseInterface;
use App\Models\Product;
use App\Models\ProductMaterial;
use App\Models\Warehouse;

class ProductRepository implements BaseInterface
{
    public function getRepositoryRequest($data)
    {

        $productMaterialsData = $data; // So'rovlarni qabul qiladi
        $productIds = array_column($productMaterialsData, 'product_id'); // So'rovdagi product idlarni massivga olyapti
        $matchingProducts = Product::whereIn('id', $productIds)->get(); // Product idlarni ichidan request idlarni ajratib oladi
        $uniqueMaterialsHashMap = []; // Ajratilgan product idlarni hashmaplab oladi

        foreach ($matchingProducts as $index => $matchingProduct) { // So'ralgan productlarni index bilan yurib chiqadi
            $productId = $matchingProduct->id;
            $productMaterials = ProductMaterial::where('product_id', $productId)->get();// So'ralgan productlar uchun qanday material ketishi aniqlanadi
            $matchingProduct->materials = $productMaterials->map(function ($item) use ($index, $productMaterialsData, &$uniqueMaterialsHashMap) {
                $uniqueMaterialsHashMap[$item->material_id] = true;
                $item->qty = $item->quantity * $productMaterialsData[$index]['qty'];
                return $item; // map yordamida so'ralgan mahsulot uchun qancha material ketishi aniqlab olinadi
            });
        }

        $materialsIds = array_keys($uniqueMaterialsHashMap);// hashmaplangan idlarni massivga o'tkaziladi
        $warehouses = Warehouse::whereIn('material_id', $materialsIds)->get(); // So'ralgan product bo'yicha materiallar ombordan olinadi
        foreach ($matchingProducts as $matchingProduct) { // va response qilinadi omborda yo'q materiallar null qilib qaytarib yuboriladi
            $matchingProduct->product_materials = collect([]);
            foreach ($matchingProduct->materials as $material) {
                $qty = $material->qty;
                $materialWarehouses = $warehouses -> filter(function ($item) use ($material) {
                                     return $item->material_id == $material->material_id & $item->remainder > 0;
                                 });

                while ($qty !== 0) {
                    foreach ($materialWarehouses as $index => $materialWarehouse) {
                        if ($materialWarehouse->remainder > $qty) {
                            $matchingProduct->product_materials->push([
                                "warehouse_id" => $materialWarehouse->id,
                                "material_name" => $materialWarehouse->material->material_name,
                                "qty" => $qty,
                               "price" => $materialWarehouse->price,
                           ]);
                           $materialWarehouse->remainder -= $qty;
                           $qty = 0;
                        } else if ($materialWarehouse->remainder < $qty) {
                            $matchingProduct->product_materials->push([
                                "warehouse_id" => $materialWarehouse->id,
                                "material_name" => $materialWarehouse->material->material_name,
                                "qty" => $materialWarehouse->remainder,
                               "price" => $materialWarehouse->price,
                           ]);
                           $qty -= $materialWarehouse->remainder;
                           $materialWarehouse->remainder = 0;
                        }
                    }

                    if($qty !== 0) {
                        $matchingProduct->product_materials->push([
                            "warehouse_id" => null,
                            "material_name" => $materialWarehouse->material->material_name,
                            "qty" => $qty,
                           "price" => null
                        ]);
                        $qty = 0;
                    }
                }
            }
        }
        $result = collect([]);
        foreach($matchingProducts as $index => $matchingProduct){
            $result->push([
                "product_name" => $matchingProduct->product_name,
                "product_quantity" => $productMaterialsData[$index]['qty'],
                "product_materias" =>  $matchingProduct-> product_materials,
            ]);
        }

        return $result;
    }
}
