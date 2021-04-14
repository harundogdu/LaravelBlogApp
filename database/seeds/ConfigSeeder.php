<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ConfigSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       DB::table('configs')->insert([
           'title' => 'Harun Doğdu Blog',
           'aboutOfCreator' => "7 Şubat 1998'de Ankara'nın Altındağ ilçesinde doğdum. İlköğretim dönemimi burada tamamlamamın ardından İMKB Mesleki ve Teknik Anadolu lisesini kazanarak lise hayatıma başladım. Lisede bulunduğum sayısal bölümünde derslerin yanısıra başlangıç seviyesi C# ve Sql programlama öğrenmeye başladım. Lise dönemi ardından Karadeniz Teknik Üniversitesi Yazılım Mühendisliği bölümüne girmeye hak kazandım ve halen eğitim hayatıma burada devam ediyorum. Özel olarak web ve grafik tasarımı, mobil uygulama geliştirme (React Native), gömülü programlama ile ilgileniyorum. İlgili konular üzerine freelancer olarak hizmet veriyorum.",
           'created_at' => now(),
           'updated_at' => now()
       ]);
    }
}
