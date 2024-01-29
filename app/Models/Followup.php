<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Followup extends Model
{
    use HasFactory;

    protected $fillable = [
        'unique_key',
        'soft_delete',
        'customer_id',
        'lead_id',
        'product_id',
        'employee_id',
        'date',
        'time',
        'description',
        'next_call_date',
        'status'
    ];
}
