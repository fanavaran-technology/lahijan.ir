<?php

namespace Database\Seeders;

use App\Models\Content\MayorSpeech;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MayorSpeechSeedr extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        MayorSpeech::create([
            'full_name' => 'رضا زنده دل',
            'description' => '...',
            'image' => '...'
        ]);
    }
}
