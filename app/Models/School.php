<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'schoolNama', 
        'schoolLogo', 
        'schoolDeskripsi', 
        'schoolTelepon', 
        'schoolNomorRekening',
        'schoolNamaRekening',
        'schoolBatasPendaftaran'
    ];

    // public function admin()
    // {
    //     return $this->hasMany(Admin::class, 'admin_id'); // Definisikan relasi dengan model Admin
    // }
}
