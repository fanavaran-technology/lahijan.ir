<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (Setting::DEFAULT_SETTING as $key => $value)
        {   
            Setting::create([
                'key'           => $key,
                'value'         => $value
            ]);
        }
    }
}
