<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Interfaces\ClassPromoRepositoryInterface;
use App\Http\Controllers\MainController;
class ClassPromoController extends MainController
{
    private ClassPromoRepositoryInterface $classPromoRepository;

    public function __construct(ClassPromoRepositoryInterface $classPromoRepository) 
    {
        $this->classPromoRepository = $classPromoRepository;
    }

    public function generatePromoCode(Request $req)
    {
        try{
            $validatorArr = array();
            $validatorArr["pack_id"] = 'required|string';
            $validatorArr["discount"] = 'required|numeric';

            $validator = $this->is_param_valid($req->all(),$validatorArr);
            if ($validator->failed) {
            return response($validator->return,400);
            }
            
           $promoCodeResult = $this->classPromoRepository->generatePromoCode($req);
           //return $data;
           return response()->json(["errorCode" => 0, "message" => 'Success', "promoCode" => $promoCodeResult]);
            
        }catch(\Exception $e){
            return array("errorCode" => $e->getCode(), "message" => $e->getMessage(), "promoCode" => null);
        }
        
    }
    public function getPromoData(Request $req)
    {
        try{
            $validatorArr = array();
            $validatorArr["pack_id"] = 'required|string';
            $validatorArr["promo_code"] = 'required|string';

            $validator = $this->is_param_valid($req->all(),$validatorArr);
            if ($validator->failed) {
            return response($validator->return,400);
            }
            
           $promoData = $this->classPromoRepository->getPromoData($req);
           $promoData = $promoData->first();
           if($promoData){
            return response()->json(["errorCode" => 0, "message" => 'Success', "promoData" => $promoData]);
           }
           return response()->json(["errorCode" => 404, "message" => 'Promo Code does not match', "promoData" => null]);
           
            
        }catch(\Exception $e){
            return array("errorCode" => $e->getCode(), "message" => $e->getMessage(), "promoData" => null);
        }
        
    }


}
