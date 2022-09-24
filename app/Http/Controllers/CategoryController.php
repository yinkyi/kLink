<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Interfaces\CategoryRepositoryInterface;
use App\Http\Controllers\MainController;

class CategoryController extends MainController
{
    private CategoryRepositoryInterface $CATEGORY_RESPOSITORY;
    private $MESSAGE;
    private $ERROR_CODE;

    public function __construct(CategoryRepositoryInterface $category_respository) 
    {
        $this->CATEGORY_RESPOSITORY = $category_respository;
        $this->MESSAGE = "Success";
        $this->ERROR_CODE = 0;

    }
    public function index(Request $req)
    {
        try{
            $validatorArr = array();
            $validatorArr["id"] = 'integer|nullable';
            $validatorArr["name"] = 'string|nullable';
            $validatorArr["descending"] = 'boolean|nullable';
            $validatorArr["rowsPerPage"] = 'required|numeric';

            $validator = $this->is_param_valid($req->all(),$validatorArr);
            if ($validator->failed) {
            return response($validator->return,400);
            }
            
           $categories = $this->CATEGORY_RESPOSITORY->getAllCagegories($req);

           $category_data=$categories->paginate($req->rowsPerPage);
         
            //return $data;
            return response()->json(["errorCode" => $this->ERROR_CODE, "message" => $this->MESSAGE, "data" => $category_data]);
            
        }catch(\Exception $e){
            return array("errorCode" => $e->getCode(), "message" => $e->getMessage(), "data" => null);
        }
        
    }    
    public function create(Request $req)
    {
        try{
            $validatorArr = array();            
            $validatorArr["name"] = 'required|string';

            $validator = $this->is_param_valid($req->all(),$validatorArr);
            if ($validator->failed) {
            return response($validator->return,400);
            }
            
            $category = $this->CATEGORY_RESPOSITORY->createCategory($req);
         
            //return $data;
            return response()->json(["errorCode" => $this->ERROR_CODE, "message" => $this->MESSAGE, "data" => $category]);
            
        }catch(\Exception $e){
            return array("errorCode" => $e->getCode(), "message" => $e->getMessage(), "data" => null);
        }
        
    }
    public function update(Request $req)
    {
        try{
            $validatorArr = array();
            $validatorArr["id"] = 'integer|required';
            $validatorArr["name"] = 'string|required';

            $validator = $this->is_param_valid($req->all(),$validatorArr);
            if ($validator->failed) {
            return response($validator->return,400);
            }

            $category = $this->CATEGORY_RESPOSITORY->updateCategory($req);
         
            //return $data;
            return response()->json(["errorCode" => $this->ERROR_CODE, "message" => $this->MESSAGE, "data" => $category]);
            
        }catch(\Exception $e){
            return array("errorCode" => $e->getCode(), "message" => $e->getMessage(), "data" => null);
        }
        
    }
    public function delete(Request $req)
    {
        try{
            $validatorArr = array();
            $validatorArr["id"] = 'integer|required';

            $validator = $this->is_param_valid($req->all(),$validatorArr);
            if ($validator->failed) {
            return response($validator->return,400);
            }

            $category = $this->CATEGORY_RESPOSITORY->deleteCategory($req);

            //return $data;
            return response()->json(["errorCode" => $this->ERROR_CODE, "message" => $this->MESSAGE, "data" => $category]);
            
        }catch(\Exception $e){
            return array("errorCode" => $e->getCode(), "message" => $e->getMessage(), "data" => null);
        }
        
    }
}
