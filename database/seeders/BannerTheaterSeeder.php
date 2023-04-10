<?php

namespace Database\Seeders;

use App\Models\Content\BannerTheater;
use App\Models\Content\Theater;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BannerTheaterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        BannerTheater::create([
            'alt' => 'تئاتر شهروندی لاهیجان',
            'image' => 'images\content\banner-theater\2023\04\09\1681066862.jpg'
        ]);
    }
}
