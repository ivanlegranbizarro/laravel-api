<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Database\Factories\ProductFactory;
use Database\Factories\ReviewFactory;
use Database\Factories\UserFactory;
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
        UserFactory::new()->count(50)->create();
        ProductFactory::new()->count(100)->create();
        ReviewFactory::new()->count(300)->create();
    }
}
