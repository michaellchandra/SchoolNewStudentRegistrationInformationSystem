<?php

namespace App\Http\Controllers;
use App\Models\Registration;

use App\Enums\RegistrationStatus;

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
        //
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
        $formPaymentRevisionRequired =$registration->hasCompletedStep(RegistrationStatus::STATUS_FORM_PAYMENT_REVISION_REQUIRED);
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
        $administrativePaymentVerificationPending =$registration->hasCompletedStep(RegistrationStatus::STATUS_ADMINISTRATIVE_PAYMENT_VERIFICATION_PENDING);
        $administrativePaymentRevisionRequired = $registration->hasCompletedStep(RegistrationStatus::STATUS_ADMINISTRATIVE_PAYMENT_REVISION_REQUIRED);
        $administrativePaymentVerified = $registration->hasCompletedStep(RegistrationStatus::STATUS_ADMINISTRATIVE_PAYMENT_VERIFIED);

        return view('registration.status');
    }

}
