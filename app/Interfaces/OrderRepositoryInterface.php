<?php

namespace App\Interfaces;

interface OrderRepositoryInterface 
{
    public function sendOrder($request);
}