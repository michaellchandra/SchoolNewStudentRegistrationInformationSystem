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
        Schema::create('schools', function (Blueprint $table) {
            $table->id();
            // $table->unsignedBigInteger('admin_id');
            // $table->foreign('admin_id')->references('id')->on('admins')->onDelete('cascade');
            $table->string('schoolNama');
            $table->string('schoolLogo')->nullable();
            $table->string('schoolDeskripsi')->nullable();
            $table->string('schoolTelepon')->nullable();
            $table->string('schoolNomorRekening')->nullable();
            $table->string('schoolNamaRekening')->nullable();
            $table->string('schoolBiayaFormulir')->nullable();
            $table->date('schoolBatasPendaftaran')->nullable();
            $table->text('schoolSyaratKetentuanPendaftaran')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schools');
    }
};
