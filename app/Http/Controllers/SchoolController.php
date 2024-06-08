<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\School;
use App\Models\User;
use App\Models\Payment;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;


class SchoolController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $school = School::first();
        $payment = Payment::all();
        if ($school !== null) {
            return view('admin.schoolsetting-admin', compact('school','payment'))->with('navbarSchool', $school);
        } else {
            return redirect()->route('admin.school.create')->with('message', 'Anda harus membuat sekolah terlebih dahulu.');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view('admin.tambahSchool-admin');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //Validasi input form sekolah
        $request->validate([
            'schoolNama' => 'required|string|max:255',
            'schoolDeskripsi' => 'required|string',
            'schoolTelepon' => 'required|string|max:20',
            'schoolLogo'=> 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'schoolBiayaFormulir' => 'required|string|max:255',
            'schoolBatasPendaftaran'=> 'required|date',
        ]);

        // Mendapatkan admin yang sedang login
        $admin = User::where('role', 'admin')->get();
        $directory = 'public/schoolSettings';
        if (!Storage::exists($directory)) {
            // Membuat direktori jika belum ada
            Storage::makeDirectory($directory, 0777, true); 
        }
        // Menyimpan file sesuai dengan nama file
        $file = $request->file('schoolLogo');
        $filename = $file->getClientOriginalName();
        $file->storeAs($directory, $filename);

        // Cek Permission jika bukan admin
        if (!$admin) {
            return redirect()->route('admin.school.index')->with('error', 'Anda tidak memiliki izin untuk menambahkan sekolah.');
        }

        // Membuat sekolah baru
        $school = new School([
            'schoolNama' => $request->get('schoolNama'),
            'schoolDeskripsi' => $request->get('schoolDeskripsi'),
            'schoolTelepon' => $request->get('schoolTelepon'),
            'schoolLogo' => $filename,
            'schoolNomorRekening' =>$request->get('schoolNomorRekening'),
            'schoolNamaRekening' => $request->get('schoolNamaRekening'),
            'schoolBiayaFormulir'=> $request->get('schoolBiayaFormulir'),
            'schoolBatasPendaftaran' => $request->get('schoolBatasPendaftaran'),
            'schoolSyaratKetentuanPendaftaran'=> $request->get('schoolSyaratKetentuanPendaftaran')

        ]);
        // Simpan data sekolah
        $school->save();

        //Kembali ke route dengan pesan sukses
        return redirect()->route('admin.school.index')->with('success', 'Sekolah berhasil ditambahkan.');

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
    public function edit($id)
    {

        $school = School::all();
        return view('admin.schoolsetting-admin')->with('school', $school);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
{
    $request->validate([
        'schoolNama' => 'required|string|max:255',
        'schoolDeskripsi' => 'required|string',
        'schoolTelepon' => 'required|string|max:20',
        'schoolBiayaFormulir' => 'required|string|max:255',
        'schoolBatasPendaftaran'=> 'required|date',
    ]);

    
    $school = School::findOrFail($id);

    if ($request->hasFile('schoolLogo')) {

        $file = $request->file('schoolLogo');
        $filename = $file->getClientOriginalName();
        $directory = 'public/schoolSettings';

        if (!Storage::exists($directory)) {
            Storage::makeDirectory($directory, 0777, true);
        }

        $file->storeAs($directory, $filename);

        Storage::delete($directory . '/' . $school->schoolLogo);
        $school->update([
            'schoolLogo' => $filename,
        ]);
    }

    // Update informasi sekolah tanpa logo
    $school->update([
        'schoolNama' => $request->get('schoolNama'),
        'schoolDeskripsi' => $request->get('schoolDeskripsi'),
        'schoolTelepon' => $request->get('schoolTelepon'),
        'schoolNomorRekening' => $request->get('schoolNomorRekening'),
        'schoolNamaRekening' => $request->get('schoolNamaRekening'),
        'schoolBiayaFormulir'=> $request->get('schoolBiayaFormulir'),
        'schoolBatasPendaftaran' => $request->get('schoolBatasPendaftaran'),
    ]);

    return redirect()->route('admin.school.index')->with('success', 'Informasi sekolah berhasil diperbarui.');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
    // Cek sekolah berdasarkan ID
    $school = School::findOrFail($id);

    // Hapus data Logo yang ada di storage 
    Storage::delete('public/schoolSettings/' . $school->schoolLogo);

    // Hapus data sekolah dari database
    $school->delete();

    // Kembali ke route dengan pesan sukses
    return redirect()->route('admin.school.index')->with('success', 'Sekolah berhasil dihapus.');
    }

    public function sidebarViewUser(){

        $school = School::first();
        return view('includes.user-sidebar', compact('school'));

    }

    
}
