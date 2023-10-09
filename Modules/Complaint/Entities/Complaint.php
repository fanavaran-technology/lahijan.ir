<?php

namespace Modules\Complaint\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;
use Illuminate\Notifications\Notifiable;

class Complaint extends Model
{
    use HasFactory , Notifiable;

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

    protected $appends = ['full_name', 'status_label', 'reference', 'referenced_at_label'];

    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }

    public function getStatusLabelAttribute()
    {
        if (isset($this->reference_id)) {
            if ($this->is_answered) {
                return "<span class='badge badge-success'>پاسخ داده شد</span>";
            }

            if ($this->is_invalid) {
                return "<span class='badge badge-danger'>در زمان مقرر پاسخ داده نشد</span>";
            }

            return "<span class='badge badge-primary'>ارجاع شده - در انتظار پاسخ</span>";
        }

        return "<span class='badge badge-warning'>ارجاع نشده</span>";

    }

    public function getReferenceAttribute()
    {
        return $this->reference_id ? $this->user->full_name : '-';
    }

    public function getReferencedAtLabelAttribute() 
    {
        return jalaliDate($this->referenced_at) ?? 'نا مشخص';
    }

    // relationships
    public function files()
    {
        return $this->hasMany(ComplaintFile::class);
    }

    public function user() {
        return $this->belongsTo(User::class, 'reference_id');
    }

    public function userFails()
    {
        return $this->hasMany(ComplaintUserFail::class);
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
