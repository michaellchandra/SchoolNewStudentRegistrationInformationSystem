<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Enums\RegistrationStatus;


class Registration extends Model
{
    //Registration Status
   
    public $timestamps = false;
    protected $fillable = [
        'user_id',
        'registrationStatus',
        'hasilTes',
        'tanggalRegistrasi',
        
    ];

    public static function urutanTahapanRegistrasi() {
        return [
            RegistrationStatus::STATUS_ACCOUNT_REGISTERED,
            RegistrationStatus::STATUS_FORM_PAYMENT_PENDING,
            RegistrationStatus::STATUS_FORM_PAYMENT_VERIFICATION_PENDING,
            RegistrationStatus::STATUS_FORM_PAYMENT_REVISION_REQUIRED,
            RegistrationStatus::STATUS_FORM_PAYMENT_VERIFIED,
            RegistrationStatus::STATUS_BIODATA_FORM_PENDING,
            RegistrationStatus::STATUS_BIODATA_FORM_VERIFICATION_PENDING,
            RegistrationStatus::STATUS_BIODATA_FORM_REVISION_REQUIRED,
            RegistrationStatus::STATUS_BIODATA_FORM_VERIFIED,
            RegistrationStatus::STATUS_SCHEDULE_AWAITING_BY_ADMIN,
            RegistrationStatus::STATUS_SCHEDULE_CONFIRMED,
            RegistrationStatus::STATUS_TEST_RESULT_FAILED,
            RegistrationStatus::STATUS_TEST_RESULT_PASSED,
            RegistrationStatus::STATUS_ADMINISTRATIVE_PAYMENT_PENDING,
            RegistrationStatus::STATUS_ADMINISTRATIVE_PAYMENT_VERIFICATION_PENDING,
            RegistrationStatus::STATUS_ADMINISTRATIVE_PAYMENT_REVISION_REQUIRED,
            RegistrationStatus::STATUS_ADMINISTRATIVE_PAYMENT_VERIFIED,
            RegistrationStatus::STATUS_ALL_DOCUMENTS_MET_REQUIREMENTS

        ];
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}

namespace App\Enums;
class RegistrationStatus
{
    public const STATUS_ACCOUNT_REGISTERED = 'Pendaftaran Akun Selesai';
    public const STATUS_FORM_PAYMENT_PENDING = 'Belum Melakukan Pembayaran Formulir';
    public const STATUS_FORM_PAYMENT_VERIFICATION_PENDING = 'Menunggu Verifikasi Pembayaran Formulir';
    public const STATUS_FORM_PAYMENT_REVISION_REQUIRED = 'Butuh Revisi Pembayaran Formulir';
    public const STATUS_FORM_PAYMENT_VERIFIED = 'Pembayaran Formulir Terverifikasi';
    public const STATUS_BIODATA_FORM_PENDING = 'Belum Melakukan Pengisian Biodata & Berkas';
    public const STATUS_BIODATA_FORM_VERIFICATION_PENDING = 'Menunggu Verifikasi Biodata & Berkas';
    public const STATUS_BIODATA_FORM_REVISION_REQUIRED = 'Butuh Revisi Biodata & Berkas';
    public const STATUS_BIODATA_FORM_VERIFIED = 'Biodata & Berkas Terverifikasi';
    public const STATUS_SCHEDULE_AWAITING_BY_ADMIN = 'Menunggu Jadwal Tes oleh Admin';
    public const STATUS_SCHEDULE_CONFIRMED = 'Jadwal Tes Terkonfirmasi';
    public const STATUS_TEST_RESULT_FAILED = 'Hasil Tes Gagal';
    public const STATUS_TEST_RESULT_PASSED = 'Hasil Tes Lulus';
    public const STATUS_ADMINISTRATIVE_PAYMENT_PENDING = 'Belum Melakukan Pembayaran Administrasi';
    public const STATUS_ADMINISTRATIVE_PAYMENT_VERIFICATION_PENDING = 'Menunggu Verifikasi Pembayaran Administrasi';
    public const STATUS_ADMINISTRATIVE_PAYMENT_REVISION_REQUIRED = 'Butuh Revisi Pembayaran Administrasi';
    public const STATUS_ADMINISTRATIVE_PAYMENT_VERIFIED = 'Pembayaran Administrasi Terverifikasi';
    public const STATUS_ALL_DOCUMENTS_MET_REQUIREMENTS = 'Seluruh Berkas Telah Memenuhi Syarat Pendaftaran';
}