<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repository\ProductRepository;



class ProductController extends Controller
{
    protected ProductRepository $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    // Request
    // [
    //     {
    //         "product_id": 1,
    //         "qty": 30
    //     },
    //     {
    //         "product_id": 2,
    //         "qty": 20
    //     }
    // ]

    public function getRequest(Request $request){
        $result =  $this->productRepository->getRepositoryRequest($request->json()->all());
        return response()->json(['result' => $result]);
    }
}

