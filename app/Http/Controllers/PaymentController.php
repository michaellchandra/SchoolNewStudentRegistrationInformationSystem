<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Payment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;


class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $payment = Payment::all();
        if ($user && $user->role === 'admin') {
            return view('admin.payment-admin',compact('payment'));
        } elseif ($user && $user->role === 'user') {
            return view('user.payment-user',compact('payment'));
        }
        abort(403, 'Unauthorized');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'paymentProof' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $payment = new Payment([
            'user_id' => auth()->id(),
            'paymentDate' => now(),
            'paymentStatus' => 'pending',
            'paymentCategory' => $request->paymentCategory,
            'paymentProof' => $request->file('paymentProof')->store('paymentProofs', 'public'),
        ]);

        $payment->save();

        return redirect()->back()->with('success', 'Payment proof uploaded successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        $totalPayment = $this->calculateTotalPayment($user);
        return view('payment.form', compact('user', 'totalPayment'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }


    public function pendingTransactions()
    {
        $pendingPayments = Payment::where('paymentStatus', 'pending')->get();
        return view('admin.pending_transactions', compact('pendingPayments'));
    }

    public function approvePayment(Payment $payment)
    {
        $payment->update(['paymentStatus' => 'approved']);
        return redirect()->back()->with('success', 'Payment approved successfully!');
    }

    public function rejectPayment(Request $request, Payment $payment)
    {
        $request->validate([
            'rejectionReason' => 'required|string',
        ]);

        $payment->update([
            'paymentStatus' => 'rejected',
            'rejectionReason' => $request->rejectionReason,
        ]);

        return redirect()->back()->with('success', 'Payment rejected successfully!');
    }
}
