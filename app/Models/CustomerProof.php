<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerProof extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'prooftype',
        'proof_upload',
    ];
}
