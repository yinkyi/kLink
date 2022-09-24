<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class MainController extends Controller
{ 
  public function is_param_valid($param,$validatorArr){
    
    $validator = Validator::make($param,$validatorArr);
    if($validator->fails()){
      $response = array("failed"=>true,"return"=>array("result"=>0,"msg"=>"Invalid Parameter!","msg_detail"=>$validator->errors()));
      return (object)$response;
    }else{
      return (object)array("failed"=>false);
    }
  }


}
