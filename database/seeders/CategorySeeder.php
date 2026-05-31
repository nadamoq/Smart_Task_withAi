<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        
        $categories=[
                        [  
                            'name'=>$name='Design',
                            'description'=>'design layouts',
                            'slug'=>Str::slug($name)
                        ],
                        [   
                            'name'=>$name='Programming',
                            'description'=>'coding tasks',
                            'slug'=>Str::slug($name)
                        ], 
                        [  
                            'name'=>$name='Marketing',
                            'description'=>'marketing tasks',
                            'slug'=>Str::slug($name)
                        ],
                    ];

                    foreach($categories as $category){
                        Category::create($category);
                    }
    }
}
