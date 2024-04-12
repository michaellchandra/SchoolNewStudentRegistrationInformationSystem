<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengumuman;
use Illuminate\Support\Facades\Auth;

class PengumumanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pengumuman = Pengumuman::first();
        $users = Auth::user();
        
        if ($pengumuman){
            return view('admin.schoolsetting-admin', compact('pengumuman'))->with('pengumuman');
        }

        
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
            'pengumumanDetail' => 'required|string|max:255',
        ]);

        // Cek apakah sudah ada pengumuman
        if (Pengumuman::count() > 0) {
            // Jika sudah ada, ubah pengumuman yang sudah ada
            $pengumuman = Pengumuman::findOrFail($id);
            $pengumuman->update($request->only('pengumumanDetail'));
        } else {
            // Jika belum ada, buat pengumuman baru
            Pengumuman::create($request->only('pengumumanDetail'));
        }

        return redirect()->route('admin.pengumuman.index');
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
        $pengumuman = Pengumuman::findOrFail($id);
        $pengumuman->update($request->all());

        return redirect()->route('admin.pengumuman.index')->with('success', 'Pengumuman berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
