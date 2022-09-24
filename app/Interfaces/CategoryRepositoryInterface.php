<?php

namespace App\Interfaces;

interface CategoryRepositoryInterface 
{
    public function getAllCagegories($request);
    public function createCategory($request);
    public function updateCategory($request);
    public function deleteCategory($request);
}