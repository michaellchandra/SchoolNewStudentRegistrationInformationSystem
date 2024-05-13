<?php

namespace App\Http\Controllers;

use App\Models\Registration;
use App\Models\User;
use App\Enums\RegistrationStatus;
use Carbon\Carbon;

use Illuminate\Http\Request;

class RegistrationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        $user = User::all();
        $currentDate = Carbon::now();

        if ($currentDate->month >= 7) {
            $academicYearStart = $currentDate->year + 1;
        } else {
            $academicYearStart = $currentDate->year;
        }

        $academicYear = $academicYearStart . '-' . ($academicYearStart + 1);
        
        $registration = new Registration();
        $registration->user_id = $user->id;
        $registration->registrationStatus = RegistrationStatus::STATUS_ACCOUNT_REGISTERED;
        $registration->tahunAjaran = $academicYear;
        $registration->save();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
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


    public function checkRegistrationStatus(Request $request, $user_id)
    {
        $registration = Registration::find($user_id);

        // Pengecekan status tahapan registrasi
        $accountRegistered = $registration->hasCompletedStep(RegistrationStatus::STATUS_ACCOUNT_REGISTERED);
        $formPaymentPending = $registration->hasCompletedStep(RegistrationStatus::STATUS_FORM_PAYMENT_PENDING);
        $formPaymentVerificationPending = $registration->hasCompletedStep(RegistrationStatus::STATUS_FORM_PAYMENT_VERIFICATION_PENDING);
        $formPaymentRevisionRequired = $registration->hasCompletedStep(RegistrationStatus::STATUS_FORM_PAYMENT_REVISION_REQUIRED);
        $formPaymentVerified = $registration->hasCompletedStep(RegistrationStatus::STATUS_FORM_PAYMENT_VERIFIED);
        $biodataPending = $registration->hasCompletedStep(RegistrationStatus::STATUS_BIODATA_FORM_PENDING);
        $biodataVerificationPending = $registration->hasCompletedStep(RegistrationStatus::STATUS_BIODATA_FORM_VERIFICATION_PENDING);
        $biodataRevisionRequired = $registration->hasCompletedStep(RegistrationStatus::STATUS_BIODATA_FORM_REVISION_REQUIRED);
        $biodataVerified = $registration->hasCompletedStep(RegistrationStatus::STATUS_BIODATA_FORM_VERIFIED);
        $testScheduleAwaiting = $registration->hasCompletedStep(RegistrationStatus::STATUS_SCHEDULE_AWAITING_BY_ADMIN);
        $testScheduleConfirmed = $registration->hasCompletedStep(RegistrationStatus::STATUS_SCHEDULE_CONFIRMED);
        $testResultFailed = $registration->hasCompletedStep(RegistrationStatus::STATUS_TEST_RESULT_FAILED);
        $testResultPassed = $registration->hasCompletedStep(RegistrationStatus::STATUS_TEST_RESULT_PASSED);
        $administrativePaymentPending = $registration->hasCompletedStep(RegistrationStatus::STATUS_ADMINISTRATIVE_PAYMENT_PENDING);
        $administrativePaymentVerificationPending = $registration->hasCompletedStep(RegistrationStatus::STATUS_ADMINISTRATIVE_PAYMENT_VERIFICATION_PENDING);
        $administrativePaymentRevisionRequired = $registration->hasCompletedStep(RegistrationStatus::STATUS_ADMINISTRATIVE_PAYMENT_REVISION_REQUIRED);
        $administrativePaymentVerified = $registration->hasCompletedStep(RegistrationStatus::STATUS_ADMINISTRATIVE_PAYMENT_VERIFIED);

        return view('registration.status');
    }

    public function applyStatusTes(Request $request)
    {

         $customMessages = [
            'selectedUsers.required' => 'Tidak ada calon siswa yang dipilih, silahkan pilih minimal 1 calon siswa sebelum menerapkan Status Hasil Tes.',
        ];

        // Validasi formulir dengan pesan kesalahan yang disesuaikan
        $request->validate([
            'hasilTes' => 'required|string',
            'selectedUsers' => 'required|array',
            'selectedUsers.*' => 'integer|exists:users,id',
        ], $customMessages);

        // Ambil data yang dikirimkan dari formulir
        $userIds = $request->input('selectedUsers');
        $status = $request->input('hasilTes');

        // Proses data dan simpan status

            foreach ($userIds as $userId) {
                $registration = Registration::where('user_id', $userId)->first();
                if ($registration) {
                    if ($status === 'Lulus') {
                        $registration->registrationStatus = RegistrationStatus::STATUS_TEST_RESULT_PASSED;
                    } else if ($status === 'Tidak Lulus') {
                        $registration->registrationStatus = RegistrationStatus::STATUS_TEST_RESULT_FAILED;
                    }
                    $registration->hasilTes = $status;
                    $registration->save();
                }
            }

            return redirect()->back()->with('success', 'Status berhasil diterapkan untuk calon siswa yang dipilih.');

    }
}
