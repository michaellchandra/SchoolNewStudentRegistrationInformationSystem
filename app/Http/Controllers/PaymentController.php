<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Payment;
use App\Models\School;
use App\Models\Biodata;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Models\Registration;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

use App\Enums\RegistrationStatus;
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
            $totalFormulir = DB::table('payments')
                ->where('paymentStatus', 'approved')
                ->where('paymentCategory', 'formulir')
                ->count();

            $totalAdministrasi = DB::table('payments')
                ->where('paymentStatus', 'approved')
                ->where('paymentCategory', 'administrasi')
                ->count();

            $totalVerifyingPayments = DB::table('payments')
                ->where('paymentStatus', 'verifying')
                ->whereIn('paymentCategory', ['formulir', 'administrasi'])
                ->count();

            $verifyingPayments = Payment::where('paymentStatus', 'Verifying')->get();

            return view('admin.payment-admin', compact('payment', 'user', 'totalFormulir', 'totalAdministrasi', 'totalVerifyingPayments', 'verifyingPayments'));
        } elseif ($user && $user->role === 'user') {
            $payments = Payment::where('user_id', $user->id)->get();
            $school = School::first();
            return view('user.payment-user', compact('payments','school'));
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

    $user_id = auth()->id();
    $directory = 'public/' . $user_id . '/PaymentProofs';
    if (!Storage::exists($directory)) {
        Storage::makeDirectory($directory, 0777, true);
    }

    $file = $request->file('paymentProof');
    $filename = $file->getClientOriginalName();
    $file->storeAs($directory, $filename);

    $paymentCategory = $request->paymentCategory;

    $paymentAmount = 0;
    if ($paymentCategory === 'formulir') {
        $school = School::first();
        $paymentAmount = $school->schoolBiayaFormulir;
    } elseif ($paymentCategory === 'administrasi') {
        $paymentAmount = $request->input('paymentAmount');
    }

    // Temukan pembayaran yang ada untuk pengguna ini berdasarkan kategori pembayaran
    $payment = Payment::where('user_id', $user_id)
                        ->where('paymentCategory', $paymentCategory)
                        ->first();


    if ($payment) {
        
        $paymentAmount = $paymentCategory === 'formulir' ? $school->schoolBiayaFormulir : $payment->paymentAmount;
    
        $payment->update([
            'paymentDate' => now(),
            'paymentAmount' => $paymentAmount,
            'paymentStatus' => 'Verifying',
            'paymentProof' => $filename,
            'updated_at_submit' => now()
        ]);
    } else {
        // Jika belum ada, buat pembayaran baru
        $payment = new Payment([
            'user_id' => $user_id,
            'paymentDate' => now(),
            'paymentAmount' => $paymentCategory === 'formulir' ? $school->schoolBiayaFormulir : $request->input('paymentAmount'),
            'paymentStatus' => 'Verifying',
            'paymentCategory' => $paymentCategory,
            'paymentProof' => $filename,
            'updated_at_submit' => now()
        ]);
        $payment->save();
    }

    // Tentukan status pendaftaran berdasarkan kategori pembayaran
    $registrationStatus = '';
    if ($paymentCategory === 'formulir') {
        $registrationStatus = RegistrationStatus::STATUS_FORM_PAYMENT_VERIFICATION_PENDING;
    } elseif ($paymentCategory === 'administrasi') {
        $registrationStatus = RegistrationStatus::STATUS_ADMINISTRATIVE_PAYMENT_VERIFICATION_PENDING;
    }

    // Update status pendaftaran pada model Registration
    $registration = Registration::where('user_id', $user_id)->first();
    $registration->registrationStatus = $registrationStatus;
    $registration->save();

    return redirect()->back()->with('success', 'Terima kasih, bukti pembayaran telah berhasil terkirim');
}



    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
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





    public function approvePayment(Payment $payment)
    {
        $registrationStatus = '';
        if ($payment->paymentCategory === 'formulir') {
            $registrations = $payment->user->registrations;
            foreach ($registrations as $registration) {
                $registration->registrationStatus = RegistrationStatus::STATUS_FORM_PAYMENT_VERIFIED;
                $registration->save();
            }
        } elseif ($payment->paymentCategory === 'administrasi') {

            $registrations = $payment->user->registrations;

            foreach ($registrations as $registration) {
                $registration->registrationStatus = RegistrationStatus::STATUS_ADMINISTRATIVE_PAYMENT_VERIFIED;
                $registration->save();
            }
        }

        $payment->update([
            'paymentAmount'=> $payment->paymentAmount,
            'paymentStatus' => 'approved',
            'updated_at_accepted' => now()
        ]);

        return redirect()->back()->with('success', 'Pembayaran berhasil diterima');
    }

    public function rejectPayment(Request $request, Payment $payment)
    {
        
        if ($payment->paymentCategory === 'formulir') {
            $request->validate([
                'rejectionReason' => 'required|string',
            ]);
            $registrations = $payment->user->registrations;
            foreach ($registrations as $registration) {
                $registration->registrationStatus = RegistrationStatus::STATUS_FORM_PAYMENT_REVISION_REQUIRED;

                // Simpan perubahan pada setiap objek pendaftaran
                $registration->save();
            }
        } elseif ($payment && $payment->paymentCategory === 'administrasi') {
            $request->validate([
                'rejectionReason' => 'required|string',
                // 'paymentAmount' => $payment->paymentAmount
            ]);
        
            $registrations = $payment->user->registrations;

            foreach ($registrations as $registration) {

                $registration->registrationStatus = RegistrationStatus::STATUS_ADMINISTRATIVE_PAYMENT_REVISION_REQUIRED;

                // Simpan perubahan pada setiap objek pendaftaran
                $registration->save();
            }
        }
        $payment->update([
            'paymentStatus' => 'rejected',
            'rejectionReason' => $request->rejectionReason,
            'updated_at_revision' => now(),
            'paymentAmount' => $payment->paymentAmount

        ]);

        return redirect()->back()->with('success', 'Pembayaran berhasil ditolak');
    }

    public function showPaymentProof($paymentProof)
    {
        // Dapatkan path lengkap ke file bukti pembayaran
        $user_id = auth()->id();
        $filePath = storage_path("app/public/paymentProofs/{$user_id}/{$paymentProof}");

        // Periksa apakah file ada
        if (!file_exists($filePath)) {
            abort(
                404
            );
        }

        // Tampilkan bukti pembayaran
        return response()->file($filePath);
    }


    public function semuaPayment()
    {
        $user = Auth::user();
        $payment = Payment::all();
        $verifyingPayments = Payment::where('paymentStatus', 'Verifying')->get();

        return view('admin.allPayment-admin', compact('user', 'payment', 'verifyingPayments'));
    }
}
