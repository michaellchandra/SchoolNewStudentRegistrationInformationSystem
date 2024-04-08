<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    
    protected $fillable = [
        'schoolNama', 
        'schoolLogo', 
        'schoolDeskripsi', 'schoolTelepon', 'admin_id'
    ];

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'admin_id'); // Definisikan relasi dengan model Admin
    }
}
