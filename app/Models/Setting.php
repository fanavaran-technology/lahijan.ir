<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = ['key' , 'value'];

    // default setting 
    const DEFAULT_SETTING = [
        'logo'          =>   '/images/settings/logo.jpg',
        'title'         =>   'وب سایت شهرداری لاهیجان',
        'description'   =>   'جدید ترین اخبار و رویدادی های شهر لاهیجان معرفی و خدمات به شهروندان',
        'keywords'      =>   'شهرداری لاهیجان,شهر لاهیجان,اخبار لاهیجان',
        'instagram'     =>   'https://www.instagram.com/shahrdarilahijan',
    ];


    static public function getValue($key) {
        $setting = Setting::where('key' , $key)->first();
        return $setting ? $setting->value : null;
    }
}
