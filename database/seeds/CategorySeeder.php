<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = ['Eğlence','Günlük Yaşam','Kodlama Bilgileri','Felsefi Düşünceler','Eğitim'];
        foreach($categories as $category):
        DB::table('categories')->insert([
            'name' => $category,
            'slug' => Str::slug($category),
            'created_at' => now(),
            'updated_at' => now()
        ]);
        endforeach;
    }
}
