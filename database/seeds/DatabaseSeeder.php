<?php

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
        $this->call([
            CategorySeeder::class,
            ArticleSeeder::class,
            PageSeeder::class,
            AdminSeeder::class,
            ConfigSeeder::class
        ]);
    }
}
