<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category = new Category();
        $category->description ='Bebidas';
        $category->save();

        $category = new Category();
        $category->description ='Frutas';
        $category->save();
        
        $category = new Category();
        $category->description ='Verduras';
        $category->save();        

    }
}
