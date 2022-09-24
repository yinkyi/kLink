<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Interfaces\ClassPackRepositoryInterface;
use App\Http\Controllers\MainController;
class ClassPackController extends MainController
{
    private ClassPackRepositoryInterface $classPackRepository;

    public function __construct(ClassPackRepositoryInterface $classPackRepository) 
    {
        $this->classPackRepository = $classPackRepository;
    }

    public function index(Request $req)
    {
        try{
            $validatorArr = array();
            $validatorArr["mem_tier"] = 'required|string';
            $validatorArr["sortBy"] = 'string|nullable';
            $validatorArr["descending"] = 'boolean|nullable';
            $validatorArr["rowsPerPage"] = 'required|numeric';

            $validator = $this->is_param_valid($req->all(),$validatorArr);
            if ($validator->failed) {
            return response($validator->return,400);
            }
            //response variable
            $message="Success";
            $errorCode = 0;
            $mem_tier = $req->mem_tier;
            //end response variable
           $classPacks = $this->classPackRepository->getClassPacksByFilter($req);

           $classPackData=$classPacks->paginate( $req->rowsPerPage);
        //    $total_item = $classPackData->total();
        //    $total_page = $classPackData->lastPage();
           $classPackArr = $classPackData->toArray();
           $classPackArr['pack_list'] = $classPackArr['data'];
           unset($classPackArr['data']);

           $total_colle = collect(compact("mem_tier"));           
         

   
           $data = $total_colle->merge($classPackArr);
           //return $data;
        return response()->json(["errorCode" => 0, "message" => 'Success', "data" => $data]);
            
        }catch(\Exception $e){
            return array("errorCode" => $e->getCode(), "message" => $e->getMessage(), "data" => null);
        }
        
    }


}
