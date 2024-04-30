<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use App\Enums\RegistrationStatus;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\Registration;
use Carbon\Carbon;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard';



    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'asalSekolah' => ['required', 'string', 'max:255'],
            'asalReferensiSekolah' => ['required', 'string', 'max:255']
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $user = User::create([
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'asalSekolah' => $data['asalSekolah'],
            'asalReferensiSekolah' => $data['asalReferensiSekolah']
        ]);

        // Mendapatkan tanggal sistem saat ini
        $currentDate = Carbon::now();

        // Periksa bulan saat ini
        if ($currentDate->month >= 7) {
            // Jika bulan saat ini adalah Juli atau setelahnya, tambahkan satu tahun
            $academicYearStart = $currentDate->year + 1;
        } else {
            // Jika bulan saat ini adalah sebelum Juli, gunakan tahun saat ini
            $academicYearStart = $currentDate->year;
        }

        $academicYear = $academicYearStart . '-' . ($academicYearStart + 1);
        event(new \App\Events\UserRegistered($user));
        $registration = new Registration();
        $registration->user_id = $user->id;
        $registration->registrationStatus = RegistrationStatus::STATUS_ACCOUNT_REGISTERED;
        $registration->tahunAjaran = $academicYear;
        $registration->save();

        return $user;
    }

    public function redirectTo()
    {
        // Periksa apakah pengguna adalah admin atau bukan, dan alihkan mereka ke rute yang sesuai
        if (Auth::user()->role === 'admin') {
            return '/admin/dashboard'; // Redirect ke admin dashboard
        } else {
            return '/user/dashboard'; // Redirect ke user dashboard
        }
    }
}
