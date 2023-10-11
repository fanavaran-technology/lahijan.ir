<?php

if (!function_exists('complaintConfig')) {
    function complaintConfig($keys)
    {
        $config = json_decode(file_get_contents(config('complaint.setting_path')), true);
        $keys = explode('.', $keys);

        $value = $config;

        foreach ($keys as $key) {
            if (isset($value[$key])) {
                $value = $value[$key];
            } else {
                return null;
            }
        }

        return $value;
    }
}

if (!function_exists('isImageFile')) {
    function isImageFile($path) {
        $imageExtenstions = ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'webp', 'svg', 'ico'];
        $extension = File::extension(asset($path));

        return in_array($extension, $imageExtenstions);

    }
}