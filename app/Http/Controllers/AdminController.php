<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Admin;
use App\Models\School;
use App\Models\Biodata;
use App\Models\Payment;
use Carbon\Carbon;
use App\Models\Registration;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        $users = User::all();
        $school = School::first();
        // $users = User::with('registrations')->get();
        $biodata = Biodata::all();
        $payment = Payment::all();

        $totalUsers = User::where('role', 'user')->count();

        //Registrasi Terbaru
        $latestUsers = User::where('role', '!=', 'admin')->latest()->take(5)->get();

        //Hitung Payment yang Pending
        $totalVerifyingPayments = DB::table('payments')
                ->where('paymentStatus', 'verifying')
                ->whereIn('paymentCategory', ['formulir', 'administrasi'])
                ->count();

        //Hitung Pending Biodata
        $totalVerifyingBiodata = Biodata::where('biodataStatus', 'verifying')->count();

        //Registrasi Hari Ini
        $today = Carbon::now();
        $todayDate = $today->isoFormat('dddd, D MMMM YYYY'); 
        $todayRegistrations = User::whereDate('created_at', today())->count();
        
        
        return view('admin.dashboard-admin',compact('users','school','totalUsers','totalVerifyingPayments','totalVerifyingBiodata','todayRegistrations','todayDate','latestUsers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::where('role', 'user')->get();
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
            'adminNama' => 'required|string|max:255',
            'adminTelepon' => 'required|string|max:20',
            'user_id' => 'required|exists:users,id', 
        ]);
        
        $user_id = $request->input('user_id');
        
        // Membuat direktori untuk menyimpan foto admin
        $directory = 'public/AdminProfile/' . $user_id;
        if (!Storage::exists($directory)) {
            Storage::makeDirectory($directory, 0755, true); 
        }
    
        // Menyimpan file foto admin
        if ($request->hasFile('adminFoto')) {
            $file = $request->file('adminFoto');
            $filename = $file->getClientOriginalName();
            $file->storeAs($directory, $filename);
        } else {
    
            return redirect()->back()->with('error', 'Foto admin belum diunggah.');
        }
        
    
        // Membuat dan menyimpan data admin ke dalam database
        $adminData = [
            'adminNama' => $request->input('adminNama'),
            'adminFoto' => $filename,
            'adminTelepon' => $request->input('adminTelepon'),
            'user_id' => $request->input('user_id'),
        ];
        $admin = Admin::create($adminData);
    
        $user = User::find($request->input('user_id'));
        $user->role = 'admin';
        $user->save();
    
        return redirect()->route('admin.manageAdmin')->with('success', 'Admin berhasil ditambahkan.');
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
    public function update(Request $request, $id)
{
    $request->validate([
        'adminNama' => 'required|string|max:255',
        'adminTelepon' => 'required|string|max:20',
        'user_id' => 'required|exists:users,id', 
    ]);

    // Temukan admin yang akan diperbarui
    $admin = Admin::findOrFail($id);
    $user_id = $request->input('user_id');
    
    // Membuat direktori untuk menyimpan foto admin
    $directory = 'public/AdminProfile/' . $user_id;
    if (!Storage::exists($directory)) {
        Storage::makeDirectory($directory, 0777, true);
    }

    // Menyimpan file foto admin jika ada file yang diunggah
    if ($request->hasFile('adminFoto')) {
        $file = $request->file('adminFoto');
        $filename = $file->getClientOriginalName();
        $file->storeAs($directory, $filename);

        // Hapus foto lama jika ada dan berbeda dengan yang baru
        if ($admin->adminFoto && $admin->adminFoto !== $filename) {
            Storage::delete($directory . '/' . $admin->adminFoto);
        }
        
        $admin->adminFoto = $filename;
    }

    // Memperbarui data admin di database
    $admin->adminNama = $request->input('adminNama');
    $admin->adminTelepon = $request->input('adminTelepon');
    $admin->user_id = $request->input('user_id');
    $admin->save();

    
    $user = User::find($request->input('user_id'));
    if ($user->role !== 'admin') {
        $user->role = 'admin';
        $user->save();
    }

    return redirect()->route('admin.manageAdmin')->with('success', 'Admin berhasil diperbarui.');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $admin = Admin::findOrFail($id);

        // Hapus file foto admin dari storage
        $directory = 'public/AdminProfile/' . $admin->id;
        Storage::deleteDirectory($directory);
    
        $admin->delete();
    
        
        $user = User::find($admin->user_id);
        $user->role = 'user';
        $user->save();
    
        return redirect()->route('admin.manageAdmin')->with('success', 'Admin berhasil dihapus.');
    }


    public function settings(){
        return view ('admin.settings-admin');
    }

    public function manageAdmin(){
        $admins = Admin::all();
        $users = User::where('role', 'user')->get();
        return view('admin.manageAdmin-admin', compact('admins','users'));
    }

    public function navbarAdmin(){
        $admin = auth()->user();
        $users = User::all();

        return view('includes.admin-navbar',compact('admins','users'));
    }


}
