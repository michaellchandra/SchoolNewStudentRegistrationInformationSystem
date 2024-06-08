<?php

namespace App\Http\Controllers;

use App\Models\Biodata;
use App\Models\User;
use App\Models\Payment;
use App\Http\Controllers\Controller;
use App\Models\Registration;
use Illuminate\Http\Request;
use App\Enums\RegistrationStatus;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use ZipArchive;
use Carbon\Carbon;


//Data Indonesia
use App\Models\Province;
use App\Models\Regency;
use App\Models\District;
use App\Models\Village;


class BiodataController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $loggedInUser = Auth::user();

        $users = User::with('registrations')->get();
        $biodata = Biodata::all();


        foreach ($users as $user) {

            if ($user->id === $loggedInUser->id) {

                foreach ($user->registrations as $registration) {

                    $registrationStatus = $registration->registrationStatus;
                    $registration->registrationStatus = $registrationStatus;
                }
            }
        }

        $totalUsers = User::where('role', 'user')->count();

        $totalVerifyingBiodata = Biodata::where('biodataStatus', 'verifying')->count();
        $totalAcceptedBiodata = Biodata::where('biodataStatus', 'accepted')->count();
        $verifyingBiodata = Biodata::where('biodataStatus', 'Verifying')->get();

        return view('admin.pendaftar-admin', compact('loggedInUser', 'users', 'biodata', 'registrationStatus', 'totalUsers', 'totalVerifyingBiodata', 'totalAcceptedBiodata', 'verifyingBiodata'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $user_id = auth()->id();
        $biodata = Biodata::where('user_id', $user_id)->first();
        $provinces = Province::all();
        $districts = District::all();
        $regency = Regency::all();
        

        return view('user.pengisian-biodata', compact('biodata', 'provinces','districts','regency'));
    }

    public function getKota(Request $request){
        $id_provinsi = $request->id_provinsi;
        $kotas = Regency::where('province_id',$id_provinsi)->get();

        foreach ($kotas as $kota){
            echo "<option value='$kota->id'>$kota->name</option>";
        }
        
    }
    public function getKecamatan(Request $request){
        $id_kota = $request->id_kota;
        $kecamatans = District::where('regency_id',$id_kota)->get();

        foreach ($kecamatans as $kecamatan){
            echo "<option value='$kecamatan->id'>$kecamatan->name</option>";
        }
    }


    

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $request->validate([
            
            'berkasAktaKelahiran' => 'sometimes|required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'berkasKartuKeluarga' => 'sometimes|required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'berkasKTPAyahKandung' => 'sometimes|required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'berkasKTPIbuKandung' => 'sometimes|required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'berkasKTPWali' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'scanRaportKelas7Ganjil' => 'sometimes|required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'scanRaportKelas7Genap' => 'sometimes|required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'scanRaportKelas8Ganjil' => 'sometimes|required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'scanRaportKelas8Genap' => 'sometimes|required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'scanRaportKelas9Ganjil' => 'sometimes|required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'scanRaportKelas9Genap' => 'sometimes|required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'sertifikatPrestasi' => 'sometimes|required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'sertifikatSertifikasi' => 'sometimes|required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        
        $user_id = auth()->id();

        $directory = 'public/' . $user_id . '/Biodata';
        if (!Storage::exists($directory)) {
            Storage::makeDirectory($directory, 0777, true);
        }
        $biodataData = $request->except('_token');

        foreach ($request->file() as $key => $file) {
            if ($file->isValid()) {
                $filename = $file->getClientOriginalName();
                $file->storeAs($directory, $filename);
                $biodataData[$key] = $filename;
            }
        }

        $biodata = Biodata::where('user_id', $user_id)->first();

        if ($biodata) {
            $biodataData['user_id'] = $user_id;
            $biodataData['biodataStatus'] = 'Verifying';
            $biodataData['updated_at_submit'] = now();
            
            $biodata->update($biodataData);

        } else {
            $biodataData['user_id'] = $user_id;
            $biodataData['biodataStatus'] = 'Verifying';
            $biodataData['updated_at_submit'] = now();
            Biodata::create($biodataData);
        }

        $registrationStatus = RegistrationStatus::STATUS_BIODATA_FORM_VERIFICATION_PENDING;
        $registration = Registration::where('user_id', $user_id)->first();
        $registration->registrationStatus = $registrationStatus;
        $registration->save();

        return redirect()->route('user.index')->with('success', 'Biodata berhasil disimpan');
    
    }

    public function saveProgress(Request $request){
          
        // $request->validate([
        // 'namaLengkap'=>'nullable',
        // 'jenisKelamin'=>'nullable',
        // 'nomorNIK'=>'nullable',
        // 'tempatLahir'=>'nullable',
        // 'tanggalLahir'=>'nullable',
        // 'jumlahSaudaraKandung'=>'nullable',
        // 'jumlahSaudaraAngkat'=>'nullable',
        // 'tinggiBadan'=>'nullable',
        // 'beratBadan'=>'nullable',
        // 'alamatSiswa'=>'nullable',
        // 'jenisTinggal'=>'nullable',
        // 'transportasiKeSekolah'=>'nullable',
        // 'agamaSiswa'=>'nullable',
        // 'nomorTeleponSiswa'=>'nullable',
        // 'namaSekolahAsal'=>'nullable',
        // 'alamatSekolahAsal'=>'nullable',
        // 'provinsiSekolahAsal'=>'nullable',
        // 'kotaSekolahAsal'=>'nullable',
        // 'kecamatanSekolahAsal'=>'nullable',
        // 'namaIbuKandung'=>'nullable',
        // 'pekerjaanIbuKandung'=>'nullable',
        // 'penghasilanIbuKandung'=>'nullable',
        // 'nomorTeleponIbuKandung'=>'nullable',
        // 'namaAyahKandung'=>'nullable',
        // 'pekerjaanAyahKandung'=>'nullable',
        // 'penghasilanAyahKandung'=>'nullable',
        // 'nomorTeleponAyahKandung'=>'nullable',
        // 'namaWali'=>'nullable',
        // 'pekerjaanWali'=>'nullable',
        // 'penghasilanWali'=>'nullable',
        // 'nomorTeleponWali'=>'nullable',
        // 'berkasAktaKelahiran' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        // 'berkasKartuKeluarga' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        // 'berkasKTPAyahKandung' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        // 'berkasKTPIbuKandung' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        // 'berkasKTPWali' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        // 'scanRaportKelas7Ganjil' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        // 'scanRaportKelas7Genap' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        // 'scanRaportKelas8Ganjil' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        // 'scanRaportKelas8Genap' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        // 'scanRaportKelas9Ganjil' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        // 'scanRaportKelas9Genap' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        // 'sertifikatPrestasi' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        // 'sertifikatSertifikasi' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        // ]);

        $user_id = auth()->id();

        $directory = 'public/' . $user_id . '/Biodata';
        if (!Storage::exists($directory)) {
            Storage::makeDirectory($directory, 0777, true);
        }
        $biodataData = $request->except('_token');
        dd($biodataData);
        foreach ($request->file() as $key => $file) {
            if ($file->isValid()) {
                $filename = $file->getClientOriginalName();
                $file->storeAs($directory, $filename);
                $biodataData[$key] = $filename;
            }
        }

        $biodata = Biodata::where('user_id', $user_id)->first();

        if ($biodata) {
            $biodataData['user_id'] = $user_id;
            $biodata->update($biodataData);

        } else {
            $biodataData['user_id'] = $user_id;
            Biodata::create($biodataData);
        }

        return redirect()->route('user.index')->with('success', 'Berhasil menyimpan progres Biodata & Berkas, jangan lupa untuk melakukan submit untuk melanjutkan ke tahap berikutnya.');
    
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
    $biodata = Biodata::findOrFail($id);
    $provinces = Province::all();
    $regency = Regency::where('province_id', $biodata->provinsiSekolahAsal)->get();
    $districts = District::where('regency_id', $biodata->kotaSekolahAsal)->get();

    $role = auth()->user()->role;

    if ($role === 'admin') {
        return view('admin.editAdministrasi-admin', compact('biodata', 'provinces', 'regency', 'districts'));
    } else {
        return view('user.editBiodata', compact('biodata', 'provinces', 'regency', 'districts'));
    }
}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'berkasAktaKelahiran' => 'sometimes|required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'berkasKartuKeluarga' => 'sometimes|required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'berkasKTPAyahKandung' => 'sometimes|required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'berkasKTPIbuKandung' => 'sometimes|required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'berkasKTPWali' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'scanRaportKelas7Ganjil' => 'sometimes|required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'scanRaportKelas7Genap' => 'sometimes|required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'scanRaportKelas8Ganjil' => 'sometimes|required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'scanRaportKelas8Genap' => 'sometimes|required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'scanRaportKelas9Ganjil' => 'sometimes|required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'scanRaportKelas9Genap' => 'sometimes|required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'sertifikatPrestasi' => 'sometimes|required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'sertifikatSertifikasi' => 'sometimes|required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
    
    
        $user_id = auth()->id();
    
        $directory = 'public/' . $user_id . '/Biodata';
        if (!Storage::exists($directory)) {
            Storage::makeDirectory($directory, 0777, true);
        }
        $biodataData = $request->except('_token');
    
        foreach ($request->file() as $key => $file) {
            if ($file->isValid()) {
                $filename = $file->getClientOriginalName();
                $file->storeAs($directory, $filename);
                $biodataData[$key] = $filename;
            }
        }
    
        $biodata = Biodata::findOrFail($id);
    
        // $biodataData['user_id'] = $user_id;
        $biodataData['user_id'] = $biodata->user_id;
        $biodata->update($biodataData);
        

    
        return redirect()->route('admin.pendaftar')->with('success', 'Biodata berhasil disimpan');
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function acceptBiodata(Biodata $biodata, Request $request)
    {
        $updated_at_accepted_formatted = Carbon::parse(now())->format('Y-m-d H:i:s');
        $biodata->update([
            'biodataStatus' => 'accepted',
            'updated_at_accepted' => $updated_at_accepted_formatted
        ]);

        $registrations = $biodata->user->registrations;

        foreach ($registrations as $registration) {

            $registration->registrationStatus = RegistrationStatus::STATUS_BIODATA_FORM_VERIFIED;

            $registration->save();
            $payment = new Payment([
                'user_id' => $registration->user_id,
                'paymentDate' => now(),
                'paymentAmount' => $request->paymentAmount, 
                'paymentStatus' => 'pending',
                'paymentCategory' => 'administrasi',
                'updated_at_submit' => now()
            ]);
            $payment->save();
        }

        return redirect()->back()->with('success', 'Biodata accepted successfully!');
    }
    
    public function rejectBiodata(Request $request, Biodata $biodata)
    {
        $request->validate([
            'rejectionReason' => 'required|string',
        ]);

        $updated_at_revision_formatted = Carbon::parse(now())->format('Y-m-d H:i:s');
        $biodata->update([
            'biodataStatus' => 'rejected',
            'rejectionReason' => $request->rejectionReason,
            'updated_at_revision' => $updated_at_revision_formatted
        ]);

        $registrations = $biodata->user->registrations;
        foreach ($registrations as $registration) {

            $registration->registrationStatus = RegistrationStatus::STATUS_BIODATA_FORM_REVISION_REQUIRED;

            $registration->save();
        }

        return redirect()->back()->with('success', 'Biodata rejected successfully!');
    }


    public function showBiodataFile($biodataData)
    {
        $user_id = auth()->id();
        $filePath = storage_path("app/public/Biodata/{$user_id}/{$biodataData}");

        if (!file_exists($filePath)) {
            abort(
                404
            );
        }

        return response()->file($filePath);
    }

    public function showBiodataFiles($user_id, $filename)
    {

        $biodata = Biodata::where('user_id', $user_id)->first();

        if (!$biodata) {
            abort(404);
        }

        
        if (!array_key_exists($filename, $biodata->toArray())) {
            abort(404); 
        }

        // Dapatkan jalur lengkap file dari penyimpanan
        $filePath = $biodata[$filename];

        // Kembalikan file sebagai respons
        return Storage::response($filePath);
    }

    public function allCalonSiswa()
    {
        $loggedInUser = Auth::user();

        $users = User::with('registrations')->get();
        $biodata = Biodata::all();


        foreach ($users as $user) {

            if ($user->id === $loggedInUser->id) {

                foreach ($user->registrations as $registration) {

                    $registrationStatus = $registration->registrationStatus;
                    $registration->registrationStatus = $registrationStatus;
                }
            }
        }

        $totalUsers = User::where('role', 'user')->count();

        $totalVerifyingBiodata = Biodata::where('biodataStatus', 'verifying')->count();
        $totalAcceptedBiodata = Biodata::where('biodataStatus', 'accepted')->count();

        $verifyingBiodata = Biodata::where('biodataStatus', 'Verifying')->get();


        return view('admin.allCalonSiswa-admin', compact('loggedInUser', 'users', 'biodata', 'registrationStatus', 'totalUsers', 'totalVerifyingBiodata', 'totalAcceptedBiodata','verifyingBiodata'));
    }
}
