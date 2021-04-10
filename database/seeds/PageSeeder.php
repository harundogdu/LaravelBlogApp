<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pages = ['Hakkımızda', 'Vizyonumuz', 'Misyonumuz', 'Kariyer'];
        $count=0;
        foreach ($pages as $page) {
            $count++;
            DB::table('pages')->insert([
                'title' => $page,
                'image' => 'https://iworkbetter.com/wp-content/uploads/2020/07/b2b.png',
                'content' => '<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque rerum sequi optio culpa est obcaecati tempore, pariatur quam ratione id aliquam vitae at iure blanditiis cumque eius sunt, consectetur nemo!</p><p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque rerum sequi optio culpa est obcaecati tempore, pariatur quam ratione id aliquam vitae at iure blanditiis cumque eius sunt, consectetur nemo!</p><p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque rerum sequi optio culpa est obcaecati tempore, pariatur quam ratione id aliquam vitae at iure blanditiis cumque eius sunt, consectetur nemo!</p>',
                'slug' => Str::slug($page),
                'order' => $count,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}
