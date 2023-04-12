<?php

namespace App\Models\Content;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CouncilMember extends Model
{
    use HasFactory;

    protected $fillable = [
        'full_name',
        'image',
        'type'
    ];

    const REQUEST_TYPES = [
        'رئیس شورا',
        'نائب رئیس شورا',
        'خزانه دار شورا ',
        'عضو شورا',
        ' سخنگو شورا',
        'منشی شورا',
    ];

    public function getType()
    {
        return self::REQUEST_TYPES[(int) $this->type];
    }
}
