<?php

namespace App\Repositories;

use App\Interfaces\ClassPackRepositoryInterface;
use App\ClassPack;

class ClassPackRepository implements ClassPackRepositoryInterface 
{
    public function getAllClassPacks() 
    {
        return ClassPack::all();
    }

    public function getClassPacksByFilter($request) 
    {
        return ClassPack::where("mem_tier",$request->mem_tier)->orderBy('tag_name','DESC')->orderBy('disp_order','ASC');
    }

    
}