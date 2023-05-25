<?php

namespace App\Services;

use App\Events\newProductMail;
use App\Models\Product;
use App\Models\ProductDetail;
use App\Models\Review;
use Illuminate\Support\Facades\Event;

class ProductService
{
    public function getProducts()
    {
        return Product::all();
    }
    public function getProduct( $id)
    {
        return Product::find($id);
    }
    public function createProduct ($data)
    {
        $product = Product::create($data);
        $data['product_id'] = $product->id;
       // $product_d = ProductDetail::create($data);
        //$product_d->product_id = $product->id;
        ProductDetail::create($data);
        Event::dispatch(new newProductMail($product));
        return $product;
    }
    public function updateProduct($id,$data)
    {
        $product = $this->getProduct($id);
       // $product->update($data);
        /*$product->title = $data['title'];
        $product->desc = $data['desc'];
        $product->user_id = $data['user_id'];*/
        //$product->details()->product_id = $product->id;
        //$product->details()->size = $data ['size'];
        //$product->details()->color = $data ['color'];
        //$product->details()->price = $data ['price'];
        /*$x = ProductDetail::where('product_id',$id);
        $x->size = $data ['size'];
        $x->color = $data ['color'];
        $x->price = $data ['price'];*/
        //$x->product_id = $product->id;
        //$x->save();
        //$product->details->product_id = $data ['product_id'];

        $product->title = $data['title'];
        $product->desc = $data['desc'];
        $product->user_id = $data['user_id'];
        $product->details->size = $data ['size'];
        $product->details->color = $data ['color'];
        $product->details->price = $data ['price'];
        $product->details->save();

        $product->save();
        return $product;
    }
    public function deleteProduct( $id)
    {
        $product = $this->getProduct($id);
       /* ProductDetail::where('product_id',$id)->delete();
        Review::where('product_id',$id)->delete();
        $product->imagable->delete();*/
        if ($product->details)
        {
            $product->details->delete();
        }
        if ($product->reviews)
        {
            $product->reviews->delete();
        }
        if ($product->imagable)
        {
            $product->imagable->delete();
        }
        $product->delete();
    }

}
