<?php

namespace App\Repositories;

use App\Interfaces\ClassPromoRepositoryInterface;
use App\ClassPromo;

class ClassPromoRepository implements ClassPromoRepositoryInterface 
{
    public function generatePromoCode($request) 
    {
        $chars = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $code = "";
        for ($i = 0; $i < 10; $i++) {
            $code .= $chars[mt_rand(0, strlen($chars)-1)];
        }
        $promoCode = ClassPromo::create(['pack_id'    => $request->pack_id,
                                        'promo_code' => $code,
                                        'discount' => $request->discount,
                                        ]);

        return $promoCode;
    }

    public function getPromoData($request) 
    {
         $classPromo =ClassPromo::where('pack_id',"=",$request->pack_id)->where('promo_code',"=",$request->promo_code);
         return $classPromo;
    }

    
}