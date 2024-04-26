<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Admin;
use App\Models\Registration;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        $users = User::all();
        return view('admin.dashboard-admin')->with('users',$users);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::all();
        return view('admin.tambahAdmin-admin')->with('users',$users);
    }

    public function pendaftarAdmin()
    {
    // $users = User::all();
    // $registration = Registration::where('user_id', $users->id)->get();
    
    }

    public function semuaAkun() {
        $users = User::all();
        return view('admin.allAkun-admin', ['users' => $users]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([

        ]);

        // Simpan data admin ke dalam database
        $admin = new Admin();
        $admin->adminNama = $request->input('adminNama');
        $admin->adminFoto = $request->input('adminFoto');
        $admin->adminTelepon = $request->input('adminTelepon');
        $admin->user_id = $request->input('user_id');
        $admin->save();


        $user = User::find($request->input('user_id'));

        $user->save();


        return redirect()->route('admin.index')->with('success', 'Admin berhasil ditambahkan.');
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

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

    }


    public function settings(){
        return view ('admin.settings-admin');
    }

    public function manageAdmin(){
        $admins = Admin::all();
        $users = User::all();
        return view('admin.manageAdmin-admin', compact('admins','users'));
    }


}
