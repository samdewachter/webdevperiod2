<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(CategoriesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(ProductsTableSeeder::class);
        $this->call(TagsTableSeeder::class);
        $this->call(FaqsTableSeeder::class);
        $this->call(ColorsTableSeeder::class);
        $this->call(ColorsProductsTableSeeder::class);
    }
}
