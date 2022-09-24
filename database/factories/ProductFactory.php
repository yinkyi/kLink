<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/
$dummy_arr = [
    [            
        "id"=>1,
        "category_id"=>1,
        "name"=>"Couple Shoes 2021 New One Man and One Woman Spring Korea",
        "image"=>"/storage/shoe1.jpg",
        "price"=>3000,
        "currency"=>'Ks',
        "in_stock"=>1,      
    ],
    [            
        "id"=>2,
        "category_id"=>1,
        "name"=>"Couple Shoes 2022 New One Man and One Woman Spring Korea",
        "image"=>"/storage/shoe2.jpg",
        "price"=>3000,
        "currency"=>'Ks',
        "in_stock"=>1,       
    ],
    [            
        "id"=>3,
        "category_id"=>1,
        "name"=>"Couple Shoes 2020 New One Man and One Woman Spring Korea",
        "image"=>"/storage/shoe3.jpg",
        "price"=>4000,
        "currency"=>'Ks',
        "in_stock"=>1,         
    ],
    [            
        "id"=>4,
        "category_id"=>2,
        "name"=>"Couple Shoes 2019 New One Man and One Woman Spring Korea",
        "image"=>"/storage/shoe4.jpg",
        "price"=>4000,
        "currency"=>'Ks',
        "in_stock"=>1,        
    ],
    [            
        "id"=>5,
        "category_id"=>2,
        "name"=>"Couple Shoes 2018 New One Man and One Woman Spring Korea",
        "image"=>"/storage/shoe5.jpg",
        "price"=>5000,
        "currency"=>'Ks',
        "in_stock"=>1,      
    ],
    [            
        "id"=>6,
        "category_id"=>3,
        "name"=>"Couple Shoes 2017 New One Man and One Woman Spring Korea",
        "image"=>"/storage/shoe6.jpg",
        "price"=>4000,
        "currency"=>'Ks',
        "in_stock"=>1,     
    ]
    ,
    [            
        "id"=>7,
        "category_id"=>3,
        "name"=>"Couple Shoes 2016 New One Man and One Woman Spring Korea",
        "image"=>"/storage/shoe7.jpg",
        "price"=>3000,
        "currency"=>'Ks',
        "in_stock"=>1,      
    ]
    ,
    [            
        "id"=>"8",
        "category_id"=>4,
        "name"=>"Couple Shoes 2023 New One Man and One Woman Spring Korea",
        "image"=>"/storage/shoe8.jpg",
        "price"=>8000,
        "currency"=>'Ks',
        "in_stock"=>1,      
    ]
];
$getCurrentData = currentDataIndex($dummy_arr);
$factory->define(Product::class, function (Faker $faker) use($getCurrentData) {
   
    $CurrentData = $getCurrentData->current();
    \Log::debug($CurrentData);
    $getCurrentData->next();
    return [
                   
            "id"=>$CurrentData["id"],
            "category_id"=>$CurrentData["category_id"],
            "name"=>$CurrentData["name"],
            "image"=>$CurrentData["image"],
            "price"=>$CurrentData["price"],
            "currency"=>$CurrentData["currency"],
            "in_stock"=>$CurrentData["in_stock"]
       
    ];
});

// function currentDataIndex($dummy_arr)
// {
//     for ($i = 0; $i < 8; $i++) {
//         yield $dummy_arr[$i];
//     }
    
// }

