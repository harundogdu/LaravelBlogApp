<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        for ($i = 0; $i < 2; $i++) :
            $title = $faker->text(50);
            DB::table('articles')->insert([
                'category_id' => rand(1,5),
                'title' => $title,
                'content' => $faker->realText(600),
                'image' => 'https://picsum.photos/'.'800'.'/'.'400',
                'slug' => Str::slug($title),
                'created_at' => $faker->dateTime('now'),
                'updated_at' => now()
            ]);
        endfor;
    }
}
