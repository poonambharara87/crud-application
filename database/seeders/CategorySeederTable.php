<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
use Carbon\Carbon; 

class CategorySeederTable extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $parent_category = ['Shirts', 'Pants'];
        $categories =   [
                    [
                        'name' => 'Shirts',
                        'status' => 'Active',
                        'parent_id' => null,
                        'created_at' => Carbon::now(), 
                        'updated_at' =>Carbon::now(), 
                    ],
                    [
                        'name' => 'Pants',
                        'status' => 'Active',
                        'parent_id' => null,
                        'created_at' => Carbon::now(), 
                        'updated_at' =>Carbon::now(), 
                    ],
                     [
                        'name' => 'Formal Shirts',
                        'status' => 'Active',
                        'parent_id' => 1,
                        'created_at' => Carbon::now(), 
                        'updated_at' =>Carbon::now(), 
                    ],
                    [
                        'name' => 'Trouser Pants',
                        'status' => 'Active',
                        'parent_id' => 2,
                        'created_at' => Carbon::now(), 
                        'updated_at' =>Carbon::now(), 
                    ],
                     [
                        'name' => 'Full SleeveShirts',
                        'status' => 'Active',
                        'parent_id' => 1,
                        'created_at' => Carbon::now(), 
                        'updated_at' =>Carbon::now(), 
                    ],
                    [
                        'name' => 'Half SleeveShirts',
                        'status' => 'Active',
                        'parent_id' => 1,
                        'created_at' => Carbon::now(), 
                        'updated_at' =>Carbon::now(), 
                    ],
                     [
                        'name' => 'Formal Pants',
                        'status' => 'Active',
                        'parent_id' => 2,
                        'created_at' => Carbon::now(), 
                        'updated_at' =>Carbon::now(), 
                    ],
                     [
                        'name' => 'Jogger Pants',
                        'status' => 'Active',
                        'parent_id' => 2,
                        'created_at' => Carbon::now(), 
                        'updated_at' =>Carbon::now(), 
                    ],
                ];
               
          
        Category::insert($categories);
       
    }
}
