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
        $users = Auth::user();
        if ($users->isAdmin()) {
            return view('admin.pengumuman-admin');
        } else {
            return view('user.pengumuman-user');
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
            $pengumuman = Pengumuman::first();
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
