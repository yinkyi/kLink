<?php

namespace App\Interfaces;

interface ProductRepositoryInterface 
{
    public function getAllProducts($request);
    public function createProduct($request);
    public function updateProduct($request);
    public function deleteProduct($request);
}