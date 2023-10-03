<?php

namespace Modules\Complaint\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;

class Complaint extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'national_code',
        'phone_number',
        'main_st',
        'auxiliary_st',
        'alley',
        'deadend',
        'builing_name',
        'postal_code',
        'tracking_code',
        'subject',
        'description',
    ];

    protected $appends = ['status_label', 'reference'];

    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }

    public function getStatusLabelAttribute() 
    {
        if (isset($this->reference_id)) {
            if ($this->is_answered) {
                return 'پاسخ داده شد';
            }

            if ($this->is_invalid) {
                return 'در زمان مقرر پاسخ داده نشد';
            }

            return 'ارجاع شده - در انتظار پاسخ';
        }
        return 'ارجاع نشده';

    }

    public function getReferenceAttribute()
    {
        return $this->reference_id ? $this->user->full_name : '-';
    }

    // relationships
    public function files() 
    {
        return $this->hasMany(ComplaintFile::class);
    }

    public function user() {
        return $this->belongsTo(User::class, 'reference_id');
    }


    // other
    public static function generateTrackingCode()
    {
        $randomNumber = rand(111111111, 999999999);

        while (Complaint::where('tracking_code', $randomNumber)->exists()) {
            $randomNumber = rand(111111111, 999999999);
        }

        return $randomNumber;
    }


}
