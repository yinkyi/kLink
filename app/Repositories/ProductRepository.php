<?php

namespace App\Repositories;

use App\Interfaces\ProductRepositoryInterface;
use App\Product;

class ProductRepository implements ProductRepositoryInterface 
{
    public function getAllProducts($request) 
    {
        $sort_by = $request->sort_by?$request->sort_by:'name';
        $order = $request->descending?'DESC':'ASC';

        $product = Product::where("in_stock",1);
        if ($request->product_name)
            $product->where('name', 'like', '%' . $request->product_name . '%');
        if ($request->category_id)
            $product->where('category_id', $request->category_id);
        
        $product->orderBy($sort_by, $order);

        return $product;
    }

    public function createProduct($request) 
    {
        $param = array(
            "name"=>$request->name,
            "category_id"=>$request->category_id,
            "image"=>$request->image_path,
            "price"=>$request->price,
            "currency"=>$request->currency,
            "in_stock"=>1
        );
        $category = Product::create($param);

        return $category;
    }
    public function updateProduct($request) 
    {
        $param = array(
            "name"=>$request->name,
            "category_id"=>$request->category_id,
            "price"=>$request->price,
            "currency"=>$request->currency,
            "in_stock"=>$request->in_stock
        );
        if($request->image){
            $param["image"] = $request->image_path;
        }
        $category = Product::find($request->id)->update($param);

        return $category;
    }
    public function deleteProduct($request) 
    {
        return  Product::where('id', $request->id)->delete();;
    }

    
}