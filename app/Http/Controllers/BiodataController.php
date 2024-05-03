<?php

namespace App\Http\Controllers;

use App\Models\Biodata;
use App\Models\User;
use App\Http\Controllers\Controller;
use App\Models\Registration;
use Illuminate\Http\Request;
use App\Enums\RegistrationStatus;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
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

        return view('admin.pendaftar-admin', compact('loggedInUser', 'users', 'biodata', 'registrationStatus', 'totalUsers', 'totalVerifyingBiodata', 'totalAcceptedBiodata'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user_id = auth()->id();
        $biodata = Biodata::where('user_id', $user_id)->first();
        $provinces = Province::all();

        return view('user.pengisian-biodata', compact('biodata', 'provinces'));
    }

    public function getKota(Request $request){
        $id_provinsi = $request->id_provinsi;
        $kotas = Regency::where('province_id',$id_provinsi)->get();

        foreach ($kotas as $kota){
            echo "<option value='$kota->name'>$kota->name</option>";
        }
    }
    public function getKecamatan(Request $request){
        $id_kota = $request->id_kota;
        $kecamatans = District::where('regency_id',$id_kota)->get();

        foreach ($kecamatans as $kecamatan){
            echo "<option value='$kecamatan->name'>$kecamatan->name</option>";
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

    public function downloadZip($id)
    {
        
        $user = User::findOrFail($id);
        $user_id = $user->id;
        $directory = 'public/' . $user_id . '/Biodata';
        $zipFileName = 'public/' . $user_id . '/Biodata.zip';
    
        // Buat zip file
        $this->createZipFile($directory, $zipFileName);
    
        // Unduh zip file
        return response()->download(storage_path($zipFileName))->deleteFileAfterSend(true);
    }

public function createZipFile($directory, $zipFileName)
{
    $zip = new ZipArchive;

    if ($zip->open($zipFileName, ZipArchive::CREATE) === TRUE) {
        $files = Storage::files($directory);

        foreach ($files as $file) {
            // Dapatkan nama file asli tanpa path
            $fileName = pathinfo($file, PATHINFO_BASENAME);

            // Tambahkan file ke zip
            $zip->addFile(storage_path('app/' . $file), $fileName);
        }

        $zip->close();

        return true;
    } else {
        return false;
    }
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
        // $user_id = auth()->id();
        
        $user = auth()->user(); // Mendapatkan data pengguna yang sedang terautentikasi
    $user_id = $user->id; // Mendapatkan ID pengguna yang sedang terautentikasi
    $biodata = Biodata::findOrFail($id);
    $provinces = Province::all();

        return view('admin.editAdministrasi-admin', compact('biodata', 'provinces','user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
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
        $user = auth()->user();
        $user_id = $user->id;
        // $user_id = auth()->id();
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
        
    
        if ($biodata) {
            
            $biodata->update($biodataData);
        }
    
        return redirect()->route('admin.pendaftar')->with('success', 'Biodata berhasil disimpan');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function acceptBiodata(Biodata $biodata)
    {
        $updated_at_accepted_formatted = Carbon::parse(now())->format('Y-m-d H:i:s');
        $biodata->update([
            'biodataStatus' => 'accepted',
            'updated_at_accepted' => $updated_at_accepted_formatted
        ]);

        // Ambil semua registrasi untuk pengguna yang terkait dengan biodata ini
        $registrations = $biodata->user->registrations;

        foreach ($registrations as $registration) {

            $registration->registrationStatus = RegistrationStatus::STATUS_BIODATA_FORM_VERIFIED;

            $registration->save();
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

        // Pastikan file yang diminta ada dalam biodata
        if (!array_key_exists($filename, $biodata->toArray())) {
            abort(404); // Berikan respons 404 Not Found jika tidak ada
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

        return view('admin.allCalonSiswa-admin', compact('loggedInUser', 'users', 'biodata', 'registrationStatus', 'totalUsers', 'totalVerifyingBiodata', 'totalAcceptedBiodata'));
    }
}
