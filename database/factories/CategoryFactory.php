<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Category;
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
        "name"=>"Category 1",
        "is_deleted"=>0,
    ],
    [            
        "id"=>2,
        "name"=>"Category 2",
        "is_deleted"=>0,   
    ],
    [            
        "id"=>3,
        "name"=>"Category 3",
        "is_deleted"=>0,        
    ],
    [            
        "id"=>4,
        "name"=>"Category 4",
        "is_deleted"=>0,       
    ],
    [            
        "id"=>5,
        "name"=>"Category 5",
        "is_deleted"=>0,    
    ],
    [            
        "id"=>6,
        "name"=>"Category 6",
        "is_deleted"=>0,    
    ]
    
];
$getCurrentData = currentDataIndex($dummy_arr);
$factory->define(Category::class, function (Faker $faker) use($getCurrentData) {
   
    $CurrentData = $getCurrentData->current();
    \Log::debug($CurrentData);
    $getCurrentData->next();
    return [
                   
            "id"=>$CurrentData["id"],
            "name"=>$CurrentData["name"],
            "is_deleted"=>$CurrentData["is_deleted"]
       
    ];
});

function currentDataIndex($dummy_arr)
{
    for ($i = 0; $i < count($dummy_arr); $i++) {
        yield $dummy_arr[$i];
    }
    
}

