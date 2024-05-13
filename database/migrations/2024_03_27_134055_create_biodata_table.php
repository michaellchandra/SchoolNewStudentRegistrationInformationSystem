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
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('biodataStatus')->nullable();
            $table->string('rejectionReason')->nullable();
    
            //Data Siswa
            $table->string('namaLengkap')->nullable();
            $table->string('jenisKelamin')->nullable();
            $table->string('nomorNIK')->nullable();
            $table->string('tempatLahir')->nullable();
            $table->date('tanggalLahir')->nullable();
            $table->string('jumlahSaudaraKandung')->nullable();
            $table->string('jumlahSaudaraAngkat')->nullable();
            $table->string('tinggiBadan')->nullable();
            $table->string('beratBadan')->nullable();
            $table->string('alamatSiswa')->nullable();
            $table->string('jenisTinggal')->nullable();
            $table->string('transportasiKeSekolah')->nullable();
            $table->string('agamaSiswa')->nullable();
            $table->string('nomorTeleponSiswa')->nullable();

            //Sekolah
            $table->string('namaSekolahAsal')->nullable();
            $table->string('alamatSekolahAsal')->nullable();
            $table->string('provinsiSekolahAsal')->nullable();
            $table->string('kotaSekolahAsal')->nullable();
            $table->string('kecamatanSekolahAsal')->nullable();

            //Ibu Kandung
            $table->string('namaIbuKandung')->nullable();
            $table->string('pekerjaanIbuKandung')->nullable();
            $table->string('penghasilanIbuKandung')->nullable();
            $table->string('nomorTeleponIbuKandung')->nullable();

            //Ayah Kandung
            $table->string('namaAyahKandung')->nullable();
            $table->string('pekerjaanAyahKandung')->nullable();
            $table->string('penghasilanAyahKandung')->nullable();
            $table->string('nomorTeleponAyahKandung')->nullable();

            //Wali
            $table->string('namaWali')->nullable();
            $table->string('pekerjaanWali')->nullable();
            $table->string('penghasilanWali')->nullable();
            $table->string('nomorTeleponWali')->nullable();

            //Berkas
            $table->string('berkasAktaKelahiran')->nullable();
            $table->string('berkasKartuKeluarga')->nullable();
            $table->string('berkasKTPAyahKandung')->nullable();
            $table->string('berkasKTPIbuKandung')->nullable();
            $table->string('berkasKTPWali')->nullable();

            //Raport
            $table->string('scanRaportKelas7Ganjil')->nullable();
            $table->string('scanRaportKelas7Genap')->nullable();
            $table->string('scanRaportKelas8Ganjil')->nullable();
            $table->string('scanRaportKelas8Genap')->nullable();
            $table->string('scanRaportKelas9Ganjil')->nullable();
            $table->string('scanRaportKelas9Genap')->nullable();

            //Sertifikat
            $table->string('sertifikatPrestasi')->nullable();
            $table->string('sertifikatSertifikasi')->nullable();

            //Timestamp
            $table->timestamp('updated_at_submit')->nullable();
            $table->timestamp('updated_at_verification')->nullable();
            $table->timestamp('updated_at_revision')->nullable();
            $table->timestamp('updated_at_accepted')->nullable();

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
