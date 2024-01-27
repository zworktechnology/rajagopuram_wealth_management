<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BillingDocument extends Model
{
    use HasFactory;

    protected $fillable = [
        'billing_id',
        'document_name',
        'document_proof',
    ];
}
