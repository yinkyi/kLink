<?php

namespace App\Interfaces;

interface ClassPromoRepositoryInterface 
{
    public function generatePromoCode($request);
    public function getPromoData($request);
}