<?php

namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\FromCollection;

class ProductExport implements FromArray
{
    /**
    * @return array
    */
    public function array():array
    {
        //return Product::all();
        $list = [];
        $products = Product::all();
        foreach ($products as $product)
        {
            $list [] = [$product->title , $product->desc , $product->user_id , $product->user->name];
        }
        return $list ;
    }
}
