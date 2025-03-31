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
        $categories = ['Footwear', 'Jullery', 'Shirts', 'Pants'];
        foreach($categories as $category){
                Category::create([
                    'name' => $category,
                    'status' => 'Active',
                    'created_at' => Carbon::now(), 
                    'updated_at' =>Carbon::now(), 
                ]);
        }
    }
}
