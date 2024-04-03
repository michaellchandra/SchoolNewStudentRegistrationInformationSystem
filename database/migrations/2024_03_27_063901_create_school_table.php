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
        Schema::create('school', function (Blueprint $table) {
            $table->bigIncrements('schoolID');
            $table->integer('adminID');
            // $table->foreign('adminID')->references('id')->on('admins')->onDelete('cascade');
            $table->string('schoolNama');
            $table->string('schoolLogo');
            $table->string('schoolDeskripsi');
            $table->string('schoolTelepon');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('school');
    }
};
