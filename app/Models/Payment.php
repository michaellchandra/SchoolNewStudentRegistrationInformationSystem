<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'user_id', 'paymentDate', 'paymentStatus', 'paymentCategory', 'paymentProof', 'rejectionReason'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
