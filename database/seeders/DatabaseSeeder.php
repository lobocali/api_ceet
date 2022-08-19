<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {   
        //Se crea usuario admin
        $user = new User();
        $user->name     = 'pruebas';
        $user->email    ='pruebas@pruebas.com';
        $user->password ='$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi';
        $user->save();

        $this->call(CategorySeeder::class);
        \App\Models\User::factory(10)->create();
        \App\Models\Product::factory(10)->create();
        
    }
}
