<?php

namespace App\Models\Clarification;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contract extends Model
{
    use HasFactory , SoftDeletes;

    protected $fillable = [
        'title' ,
        'contractor',
        'contract_date',
        'detail',
        'is_private'
    ];

    public function setContractDateAttribute($contract_date)
    {
        $correct_contract_date = substr($contract_date , 0, -3);
        $this->attributes['contract_date'] = date('Y-m-d H:i:s', $correct_contract_date);
    }
}
