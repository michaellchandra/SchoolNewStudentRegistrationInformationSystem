<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('biodata', function (Blueprint $table) {
            $table->bigIncrements('paymentID');
            $table->integer('userID');
            // $table->foreign('userID')->references('userID')->on('users')->onDelete('cascade');
            
            //Data Siswa
            $table->string('namaLengkap');
            $table->string('jenisKelamin');
            $table->string('nomorNIK');
            $table->string('tempatLahir');
            $table->date('tanggalLahir');
            $table->string('jumlahSaudaraKandung');
            $table->string('jumlahSaudaraAngkat');
            $table->string('tinggiBadan');
            $table->string('beratBadan');
            $table->string('alamatSiswa');
            $table->string('jenisTinggal');
            $table->string('transportasiKeSekolah');
            $table->string('agamaSiswa');
            $table->string('nomorTeleponSiswa');

            //Sekolah
            $table->string('namaSekolahAsal');
            $table->string('provinsiSekolahAsal');
            $table->string('kotaSekolahAsal');
            $table->string('kecamatanSekolahAsal');

            //Ibu Kandung
            $table->string('namaIbuKandung');
            $table->string('pekerjaanIbuKandung');
            $table->string('penghasilanIbuKandung');
            $table->string('nomorTeleponIbuKandung');

            //Ayah Kandung
            $table->string('namaAyahKandung');
            $table->string('pekerjaanAyahKandung');
            $table->string('penghasilanAyahKandung');
            $table->string('nomorTeleponAyahKandung');

            //Wali
            $table->string('namaWali');
            $table->string('pekerjaanWali');
            $table->string('penghasilanWali');
            $table->string('nomorTeleponWali');

            //Berkas
            $table->string('berkasAktaKelahiran');
            $table->string('berkasKartuKeluarga');
            $table->string('berkasKTPAyahKandung');
            $table->string('berkasKTPIbuKandung');
            $table->string('berkasKTPWali');

            //Raport
            $table->string('scanRaportKelas7Ganjil');
            $table->string('scanRaportKelas7Genap');
            $table->string('scanRaportKelas8Ganjil');
            $table->string('scanRaportKelas8Genap');
            $table->string('scanRaportKelas9Ganjil');
            $table->string('scanRaportKelas9Genap');

            //Sertifikat
            $table->string('sertifikatPrestasi');
            $table->string('sertifikatSertifikasi');






        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('biodata');
    }
};
