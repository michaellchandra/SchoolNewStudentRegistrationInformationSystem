<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Payment;
use App\Models\Biodata;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Models\Registration;
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
            return view('admin.payment-admin', compact('payment','user'));
        } elseif ($user && $user->role === 'user') {
            $payments = Payment::where('user_id', $user->id)->get();
            return view('user.payment-user', compact('payments'));
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
            Storage::makeDirectory($directory, 0777, true); // Membuat direktori secara rekursif jika belum ada
        }
        // Menyimpan file ke dalam direktori yang sesuai
        $file = $request->file('paymentProof');
        $filename = $file->getClientOriginalName(); // Nama asli file
        $file->storeAs($directory, $filename);

        // Cek apakah pembayaran sudah ada untuk pengguna ini
        $payment = Payment::where('user_id', $user_id)->first();

        // Jika pembayaran sudah ada, ganti informasi pembayaran yang sudah ada
        if ($payment) {
            $payment->update([
                'paymentDate' => now(),
                'paymentAmount' => 0,
                'paymentStatus' => 'Verifying',
                'paymentCategory' => $request->paymentCategory,
                'paymentProof' => $filename,
            ]);
        } else {
            // Jika tidak, buat pembayaran baru
            $payment = new Payment([
                'user_id' => $user_id,
                'paymentDate' => now(),
                'paymentAmount' => 0,
                'paymentStatus' => 'Verifying',
                'paymentCategory' => $request->paymentCategory,
                'paymentProof' => $filename
            ]);
            $payment->save();
        }

        $registrationStatus = '';
        if ($request->paymentCategory === 'formulir') {
            $registrationStatus = RegistrationStatus::STATUS_FORM_PAYMENT_VERIFICATION_PENDING;
        } elseif ($request->paymentCategory === 'administrasi') {
            $registrationStatus = RegistrationStatus::STATUS_ADMINISTRATIVE_PAYMENT_VERIFICATION_PENDING;
        }

        // Mengupdate registrationStatus pada model Registration
        $registration = Registration::where('user_id', $user_id)->first();
        $registration->registrationStatus = $registrationStatus;
        $registration->save();

        return redirect()->back()->with('success', 'Payment proof uploaded successfully!');
    }

//     public function store(Request $request)
// {
//     $request->validate([
//         // Tambahkan validasi untuk setiap file yang diunggah di sini
//     ]);

//     $user_id = auth()->id();
//     $directory = 'public/' . $user_id . '/Biodata';
//     if (!Storage::exists($directory)) {
//         Storage::makeDirectory($directory, 0777, true); // Membuat direktori secara rekursif jika belum ada
//     }

//     $biodataData = $request->except('_token');

//     foreach ($request->file() as $key => $file) {
//         if ($file->isValid()) {
//             $filename = $file->getClientOriginalName();
//             $file->storeAs($directory, $filename);
//             $biodataData[$key] = $filename;
//         }
//     }

//     $biodata = Biodata::where('user_id', $user_id)->first();

//     if ($biodata) {
//         $biodata->update($biodataData);
//     } else {
//         $biodataData['user_id'] = $user_id;
//         $biodataData['biodataStatus'] = 'Verifying';
//         Biodata::create($biodataData);
//     }

//     $registrationStatus = RegistrationStatus::STATUS_BIODATA_FORM_VERIFICATION_PENDING;
//     $registration = Registration::where('user_id', $user_id)->first();
//     $registration->registrationStatus = $registrationStatus;
//     $registration->save();

//     return redirect()->route('user.index')->with('success', 'Biodata berhasil disimpan');
// }


    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        // $totalPayment = $this->calculateTotalPayment($user);
        // return view('payment.form', compact('user', 'totalPayment'));
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
        $registrationStatus = '';
        if ($payment->paymentCategory === 'formulir') {
            $registrations = $payment->user->registrations;
            foreach ($registrations as $registration) {
                // Atur status pendaftaran
                $registration->registrationStatus = RegistrationStatus::STATUS_FORM_PAYMENT_VERIFIED;

                // Simpan perubahan pada setiap objek pendaftaran
                $registration->save();
            }
        } elseif ($payment->paymentCategory === 'administrasi') {

            $registrations = $payment->user->registrations;

            foreach ($registrations as $registration) {
                // Atur status pendaftaran
                $registration->registrationStatus = RegistrationStatus::STATUS_ADMINISTRATIVE_PAYMENT_VERIFIED;

                // Simpan perubahan pada setiap objek pendaftaran
                $registration->save();
            }
        }

        // Perbarui status pembayaran menjadi 'approved'
        $payment->update(['paymentStatus' => 'approved']);

        return redirect()->back()->with('success', 'Payment approved successfully!');
    }

    public function rejectPayment(Request $request, Payment $payment)
    {
        $request->validate([
            'rejectionReason' => 'required|string',
        ]);
        if ($payment->paymentCategory === 'formulir') {
            $registrations = $payment->user->registrations;
            foreach ($registrations as $registration) {
                // Atur status pendaftaran
                $registration->registrationStatus = RegistrationStatus::STATUS_FORM_PAYMENT_REVISION_REQUIRED;

                // Simpan perubahan pada setiap objek pendaftaran
                $registration->save();
            }
        } elseif ($payment->paymentCategory === 'administrasi') {

            $registrations = $payment->user->registrations;

            foreach ($registrations as $registration) {
                // Atur status pendaftaran
                $registration->registrationStatus = RegistrationStatus::STATUS_ADMINISTRATIVE_PAYMENT_REVISION_REQUIRED;

                // Simpan perubahan pada setiap objek pendaftaran
                $registration->save();
            }
        }
        $payment->update([
            'paymentStatus' => 'rejected',
            'rejectionReason' => $request->rejectionReason,
        ]);

        return redirect()->back()->with('success', 'Payment rejected successfully!');
    }

    public function showPaymentProof($paymentProof)
{
    // Dapatkan path lengkap ke file bukti pembayaran
    $user_id = auth()->id();
    $filePath = storage_path("app/public/paymentProofs/{$user_id}/{$paymentProof}");
    
    // Periksa apakah file ada
    if (!file_exists($filePath)) {
        abort(404
    ); 
    }

    // Tampilkan bukti pembayaran
    return response()->file($filePath);
}

}
