<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->insert([
         'name' => 'Harun Doğdu',
         'email' => 'harundogdu06@gmail.com',
         'password' => bcrypt(123),
        ]);
    }
}
