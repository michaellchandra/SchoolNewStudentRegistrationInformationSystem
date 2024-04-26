<?php

namespace App\Listeners;
use App\Models\Payment;
use App\Events\UserRegistered;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class CreatePayment
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(UserRegistered $event): void
    {
        $user = $event->user;

        // Buat pembayaran baru
        $payment = new Payment([
            'user_id' => $user->id,
            'paymentDate' => null,
            'paymentAmount'=> 0,
            'paymentStatus' => 'pending', 
            'paymentCategory'=> 'formulir',
            'paymentProof' => null, 
            'rejectionReason'=> null,
            'created_at'=> now(),
            'update_at'=> null
        ]);
        $payment->save();
    }
}
