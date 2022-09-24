<?php

namespace App\Repositories;

use App\Interfaces\CategoryRepositoryInterface;
use App\Category;

class CategoryRepository implements CategoryRepositoryInterface 
{
    public function getAllCagegories($request) 
    {
        $sort_by = $request->sort_by?$request->sort_by:'name';
        $order = $request->descending?'DESC':'ASC';

        $category = Category::where("is_deleted",0);
        if ($request->name)
            $product->where('name', 'like', '%' . $request->product_name . '%');
        
        $category->orderBy($sort_by, $order);

        return $category;
    }

    public function createCategory($request) 
    {
        $param = array(
            "name"=>$request->name,
            "is_deleted"=>0
        );
        $category = Category::create($param);

        return $category;
    }
    public function updateCategory($request) 
    {
        $param = array(
            "name"=>$request->name,
            "is_deleted"=>0
        );
        $category = Category::find($request->id)->update($param);

        return $category;
    }
    public function deleteCategory($request) 
    {
        return  Category::find($request->id)->update(["is_deleted" => true]);
    }

    
}