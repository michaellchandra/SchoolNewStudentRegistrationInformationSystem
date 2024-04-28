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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained();
            $table->date('paymentDate')->nullable();;
            $table->bigInteger('paymentAmount')->nullable();
            $table->string('paymentStatus');
            $table->string('paymentCategory');
            $table->string('paymentProof')->nullable();
            $table->string('rejectionReason')->nullable();
            $table->string('updated_at')->nullable();
            $table->string('created_at')->nullable();
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
        Schema::dropIfExists('payments');
    }
};
