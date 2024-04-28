<?php

namespace App\Http\Controllers;
use App\Models\Registration;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Payment;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Enums\RegistrationStatus;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $loggedInUser = Auth::user();
        $users = User::with('registrations')->get();
        $payments = Payment::where('user_id', $loggedInUser->id)->get();
        
        foreach ($users as $user) {
            
            if ($user->id === $loggedInUser->id) {
                foreach ($user->registrations as $registration) {
                    $registrationStatus = $registration->registrationStatus;
                    $registration->registrationStatus = $registrationStatus;
                }
            }
            
        }
        
        // $payments = Payment::where('user_id', $users->id)->get();
        return view('user.dashboard-user', compact('users','registrationStatus','payments'));
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.tambahAkun');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $request->validate([
        //     'email' => ['required', 'email', 'unique:users'],
        //     'password' => ['required', 'min:8'],
        //     'asalSekolah' => ['required'],
        //     'asalReferensiSekolah' => ['required'],
        // ]);

        User::create([
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'asalSekolah' => $request->asalSekolah,
            'asalReferensiSekolah' => $request->asalReferensiSekolah,
        ]);

        return redirect()->route('admin.pendaftarAdmin')->with('success', 'Akun pengguna berhasil ditambahkan.');
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
        $user = User::findOrFail($id); // Mengambil data pengguna berdasarkan ID
        return view('admin.editUser', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,

        ]);


        $user->update([
            'name' => $request->name,
            'email' => $request->email,

        ]);

        return redirect()->route('admin.pendaftarAdmin')->with('success', 'Akun berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);

        // Hapus pengguna dari database
        $user->delete();

        return redirect()->route('admin.pendaftarAdmin')->with('success', 'Data pengguna berhasil dihapus.');
    }


    public function resetPassword(Request $request, $id)
    {
        $request->validate([
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = User::findOrFail($id);
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->back()->with('success', 'Password pengguna berhasil direset.');
    }

    public function getTotalUsers()
    {
        $totalUsers = User::where('role', 'user')->count();
        return $totalUsers;
    }

    public function registrations()
    {
        return $this->hasMany(Registration::class);
    }
}
