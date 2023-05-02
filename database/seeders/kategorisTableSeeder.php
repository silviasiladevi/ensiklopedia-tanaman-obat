<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kategori;

class kategorisTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $kategoris = new Kategori;
        $kategoris->kategori = "akar";
        $kategoris->save();

        $kategoris = new Kategori;
        $kategoris->kategori = "batang";
        $kategoris->save();

        $kategoris = new Kategori;
        $kategoris->kategori = "buah";
        $kategoris->save();

        $kategoris = new Kategori;
        $kategoris->kategori = "daun";
        $kategoris->save();
    }
}
