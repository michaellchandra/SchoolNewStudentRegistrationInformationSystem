<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'user_id', 'paymentDate', 'paymentAmount', 'paymentStatus', 'paymentCategory', 'paymentProof', 'rejectionReason','updated_at_submit','updated_at_revision','updated_at_accepted'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
