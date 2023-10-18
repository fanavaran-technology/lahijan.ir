<?php

namespace App\Rules\Complaint;

use Illuminate\Contracts\Validation\Rule;

class ComplaintFilesRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $files = explode(',' , $value);

        foreach ($files as $file) {
            if (!file_exists(dirname(__DIR__)."public_html/".  $file)) {
                return false;
            }
        }

        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'فایلها بارگذاری نشده اند.';
    }
}
