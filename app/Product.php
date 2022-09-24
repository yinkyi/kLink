<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\ModelTraits;

class Product extends Model
{
    use ModelTraits;

    protected $table='products';
    protected $guarded = [];
}
