<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\School;
use App\Models\User;
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
        if ($school !== null) {
            return view('admin.schoolsetting-admin', compact('school'))->with('navbarSchool', $school);
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
        $request->validate([
            'schoolNama' => 'required|string|max:255',
            'schoolDeskripsi' => 'required|string',
            'schoolTelepon' => 'required|string|max:20',
            'schoolLogo'=> 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'schoolBatasPendaftaran'=> 'required|date',
        ]);

        // Mendapatkan admin yang sedang login
        $admin = User::where('role', 'admin')->get();
        $directory = 'public/schoolSettings';
        if (!Storage::exists($directory)) {
            Storage::makeDirectory($directory, 0777, true); // Membuat direktori secara rekursif jika belum ada
        }

        $file = $request->file('schoolLogo');
        $filename = $file->getClientOriginalName();
        $file->storeAs($directory, $filename);

        if (!$admin) {
            return redirect()->route('admin.school.index')->with('error', 'Anda tidak memiliki izin untuk menambahkan sekolah.');
        }

        // Membuat sekolah baru dan menyimpan admin_id
        $school = new School([
            'schoolNama' => $request->get('schoolNama'),
            'schoolDeskripsi' => $request->get('schoolDeskripsi'),
            'schoolTelepon' => $request->get('schoolTelepon'),
            'schoolLogo' => $filename,
            'schoolNomorRekening' =>$request->get('schoolNomorRekening'),
            'schoolNamaRekening' => $request->get('schoolNamaRekening'),
            'schoolBatasPendaftaran' => $request->get('schoolBatasPendaftaran')

        ]);
        $school->save();

        
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
    public function update(Request $request, string $id)
    {
        $school = School::findOrFail($id);
        $school->update([
            'schoolNama' => $request->schoolNama,
            'schoolDeskripsi' => $request->schoolDeskripsi,
            'schoolTelepon' => $request->schoolTelepon,
        ]);
        return redirect()->route('admin.school.index')->with('success', 'Data sekolah berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function sidebarViewUser(){

        $school = School::first();
        return view('includes.user-sidebar', compact('school'));

    }

    // public function navbarViewAdmin(){

    //     $school = School::first();
    //     return view('includes.user-sidebar', compact('school'));

    // }
}
