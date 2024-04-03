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
        Schema::create('registration', function (Blueprint $table) {
            $table->bigIncrements('registrationID');
            $table->integer('userID');
            // $table->foreign('userID')->references('id')->on('users')->onDelete('cascade');
            $table->string('registrationStatus');
            $table->string('hasilTes');
            $table->date('tanggalRegistrasi');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registration');
    }
};
