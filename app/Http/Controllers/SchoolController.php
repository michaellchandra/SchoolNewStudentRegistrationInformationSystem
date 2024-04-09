<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\School;
use Illuminate\Support\Facades\Auth;


class SchoolController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $school = School::first();
        return view ('admin.schoolsetting-admin', compact('school'))->with('navbarSchool', $school);
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
    public function edit( $id)
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
}
