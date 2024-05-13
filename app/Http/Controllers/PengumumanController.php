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
        $user = Auth::user();

        if ($user && $user->role === 'admin') {
            if ($pengumuman) {
                return view('admin.pengumuman-admin', compact('pengumuman'));
            } else {
                return redirect()->route('admin.pengumuman.create')->with('message', 'Belum ada pengumuman, anda harus membuat pengumuman terlebih dahulu.');
            }
        } elseif ($user && $user->role === 'user') {
            if ($pengumuman) {
                return view('user.pengumuman-user', compact('pengumuman'));
            } else {
                return view('user.pengumumanEmpty-user')->with('message', 'Tidak ada informasi terkait pengumuman yang tersedia saat ini, jika ada pertanyaan silahkan hubungi WhatsApp Sekolah');
            }
        } else {
            abort(403, 'Unauthorized');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.tambahPengumuman-admin');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, string $id)
    {
        $request->validate([
            'pengumumanDetail' => 'required|string|max:255',
        ]);

        if (Pengumuman::count() > 0) {

            $pengumuman = Pengumuman::findOrFail($id);
            $pengumuman->update($request->only('pengumumanDetail'));
        } else {
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
        $pengumuman = Pengumuman::findOrFail($id);

        // Hapus pengumuman
        $pengumuman->delete();
        return redirect()->route('admin.pengumuman.index')->with('success', 'Pengumuman berhasil dihapus. Harap tambahkan pengumuman baru.');
    }
}
