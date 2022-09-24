<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Interfaces\ProductRepositoryInterface;
use App\Http\Controllers\MainController;
use App\Product;

class ProductController extends MainController
{
    private ProductRepositoryInterface $PRODUCT_RESPOSITORY;
    private $MESSAGE;
    private $ERROR_CODE;
    
    public function __construct(ProductRepositoryInterface $product_respository) 
    {
        $this->PRODUCT_RESPOSITORY = $product_respository;
        $this->MESSAGE = "Success";
        $this->ERROR_CODE = 0;

    }
    public function index(Request $req)
    {
        try{
            $validatorArr = array();
            $validatorArr["category_id"] = 'integer|nullable';
            $validatorArr["product_name"] = 'string|nullable';
            $validatorArr["sort_by"] = 'string|nullable';
            $validatorArr["descending"] = 'boolean|nullable';
            $validatorArr["rowsPerPage"] = 'required|numeric';

            $validator = $this->is_param_valid($req->all(),$validatorArr);
            if ($validator->failed) {
            return response($validator->return,400);
            }
            
           $products = $this->PRODUCT_RESPOSITORY->getAllProducts($req);

           $product_data=$products->paginate($req->rowsPerPage);
         
            //return $data;
            return response()->json(["errorCode" => $this->ERROR_CODE, "message" => $this->MESSAGE, "data" => $product_data]);
            
        }catch(\Exception $e){
            return array("errorCode" => $e->getCode(), "message" => $e->getMessage(), "data" => null);
        }
        
    }    
    public function currencyEnums()
    {
        return Product::getPossibleEnumValues('currency');
        
    }
    public function create(Request $req)
    {
        try{
            $currency_enums=$this->currencyEnums();

            $validatorArr = array();            
            $validatorArr["name"] = 'required|string';
            $validatorArr["category_id"] = 'required|string';
            $validatorArr["image"] = 'required|file|max:25000';
            $validatorArr["price"] = 'required|numeric';
            $validatorArr["currency"] = 'required|in:'.implode(",",$currency_enums);

            $validator = $this->is_param_valid($req->all(),$validatorArr);
            if ($validator->failed) {
            return response($validator->return,400);
            }

            $image_path = $this->uploadImage($req);
           
            $req->merge([
                'image_path' => $image_path["file_path"]
            ]);
            
            $product = $this->PRODUCT_RESPOSITORY->createProduct($req);
         
            //return $data;
            return response()->json(["errorCode" => $this->ERROR_CODE, "message" => $this->MESSAGE, "data" => $product]);
            
        }catch(\Exception $e){
            return array("errorCode" => $e->getCode(), "message" => $e->getMessage(), "data" => null);
        }
        
    }
    public function update(Request $req)
    {
        try{
            $currency_enums=$this->currencyEnums();

            $validatorArr = array();
            $validatorArr["id"] = 'integer|required';
            $validatorArr["name"] = 'required|string';
            $validatorArr["category_id"] = 'required|string';
            $validatorArr["image"] = 'nullable|file|max:25000';
            $validatorArr["price"] = 'required|string';
            $validatorArr["in_stock"] = 'required|boolean';
            $validatorArr["currency"] = 'required|in:'.implode(",",$currency_enums);

            $validator = $this->is_param_valid($req->all(),$validatorArr);
            if ($validator->failed) {
            return response($validator->return,400);
            }
            if($req->image){
                $image_path = $this->uploadImage($req);
                $req->merge([
                    'image_path' => $image_path["file_path"]
                ]);
            }
         
            $product = $this->PRODUCT_RESPOSITORY->updateProduct($req);
         
            //return $data;
            return response()->json(["errorCode" => $this->ERROR_CODE, "message" => $this->MESSAGE, "data" => $product]);
            
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

            $product = $this->PRODUCT_RESPOSITORY->deleteProduct($req);

            //return $data;
            return response()->json(["errorCode" => $this->ERROR_CODE, "message" => $this->MESSAGE, "data" => $product]);
            
        }catch(\Exception $e){
            return array("errorCode" => $e->getCode(), "message" => $e->getMessage(), "data" => null);
        }
        
    }
    public function uploadImage($req)
    { 
        $path = "/"."storage/";         
        $file_name = $req->file('image')->getClientOriginalName();
        $file = $req->file('image')->store("public");
        $file = explode("/",$file);
        $file_path = $path."".$file[1];
        return array("file_name" => $file_name,"file_path" => $file_path,"status" => 1);
        
    }
}
