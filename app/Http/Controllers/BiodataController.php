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
        return view('admin.pendaftar-admin', compact('loggedInUser', 'users', 'biodata', 'registrationStatus'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user_id = auth()->id();
        $biodata = Biodata::where('user_id', $user_id)->first();
        return view('user.pengisian-biodata',compact('biodata'));
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
            $biodata->update($biodataData);
            
        } else {
            $biodataData['user_id'] = $user_id;
            $biodataData['biodataStatus'] = 'Verifying';
            Biodata::create($biodataData);
        }

        

        $registrationStatus = RegistrationStatus::STATUS_BIODATA_FORM_VERIFICATION_PENDING;
        $registration = Registration::where('user_id', $user_id)->first();
        $registration->registrationStatus = $registrationStatus;
        $registration->save();

        return redirect()->route('user.index')->with('success', 'Biodata berhasil disimpan');
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

    public function acceptBiodata(Biodata $biodata)
    {
        // Ubah status biodata menjadi 'accepted'
        $biodata->update(['biodataStatus' => 'accepted']);

        // Ambil semua registrasi untuk pengguna yang terkait dengan biodata ini
        $registrations = $biodata->user->registrations;

        foreach ($registrations as $registration) {
            // Atur status pendaftaran
            $registration->registrationStatus = RegistrationStatus::STATUS_BIODATA_FORM_VERIFIED;

            // Simpan perubahan pada setiap objek pendaftaran
            $registration->save();
        }

        return redirect()->back()->with('success', 'Biodata accepted successfully!');
    }

    public function rejectBiodata(Biodata $biodata)
    {
        // Ubah status biodata menjadi 'rejected'
        $biodata->update(['biodataStatus' => 'rejected']);
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

        // Periksa apakah file ada
        if (!file_exists($filePath)) {
            abort(
                404
            );
        }

        // Tampilkan bukti pembayaran
        return response()->file($filePath);
    }

    public function showBiodataFiles($user_id, $filename)
    {
        // Dapatkan biodata dari user_id
        $biodata = Biodata::where('user_id', $user_id)->first();

        // Pastikan biodata ditemukan
        if (!$biodata) {
            abort(404); // Berikan respons 404 Not Found jika tidak ditemukan
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
}
