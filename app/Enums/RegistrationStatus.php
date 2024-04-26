<?php

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