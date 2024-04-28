<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Biodata extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'biodata';
    protected $fillable = [
        'user_id',
        'biodataStatus',
        'namaLengkap',
        'jenisKelamin',
        'nomorNIK',
        'tempatLahir',
        'tanggalLahir',
        'jumlahSaudaraKandung',
        'jumlahSaudaraAngkat',
        'tinggiBadan',
        'beratBadan',
        'alamatSiswa',
        'jenisTinggal',
        'transportasiKeSekolah',
        'agamaSiswa',
        'nomorTeleponSiswa',
        'namaSekolahAsal',
        'alamatSekolahAsal',
        'provinsiSekolahAsal',
        'kotaSekolahAsal',
        'kecamatanSekolahAsal',
        'namaIbuKandung',
        'pekerjaanIbuKandung',
        'penghasilanIbuKandung',
        'nomorTeleponIbuKandung',
        'namaAyahKandung',
        'pekerjaanAyahKandung',
        'penghasilanAyahKandung',
        'nomorTeleponAyahKandung',
        'namaWali',
        'pekerjaanWali',
        'penghasilanWali',
        'nomorTeleponWali',
        'berkasAktaKelahiran',
        'berkasKartuKeluarga',
        'berkasKTPAyahKandung',
        'berkasKTPIbuKandung',
        'berkasKTPWali',
        'scanRaportKelas7Ganjil',
        'scanRaportKelas7Genap',
        'scanRaportKelas8Ganjil',
        'scanRaportKelas8Genap',
        'scanRaportKelas9Ganjil',
        'scanRaportKelas9Genap',
        'sertifikatPrestasi',
        'sertifikatSertifikasi',
        'updated_at_submit',
        'updated_at_revision',
        'updated_at_accepted'

    ];

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }


}
