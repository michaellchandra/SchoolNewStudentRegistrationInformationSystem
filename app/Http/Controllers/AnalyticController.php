<?php

namespace App\Http\Controllers;

use App\Models\PivotAdminUser;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Biodata;

use Illuminate\Http\Request;

class AnalyticController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kotaSekolahAsal = Biodata::select('kotaSekolahAsal', DB::raw('COUNT(*) as total'))
        ->groupBy('kotaSekolahAsal')
        ->orderByDesc('total')
        ->limit(5)
        ->get();

        return view('admin.analytic-admin',compact('kotaSekolahAsal'));
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

    public function dailyRegistrations()
    {
        $todayRegistrations = User::whereDate('created_at', today())->count();

        return response()->json(['registrations' => $todayRegistrations]);
    }


    public function weeklyRegistrations()
    {
        $startOfWeek = Carbon::now()->startOfWeek();
        $endOfWeek = Carbon::now()->endOfWeek();
        $labels = [];
        $data = [];

        // Loop through each day of the week
        for ($date = $startOfWeek; $date->lte($endOfWeek); $date->addDay()) {
            $registrations = User::whereDate('created_at', $date)->count();
            $labels[] = $date->format('(D) d/m');
            $data[] = $registrations;
        }

        return response()->json([
            'labels' => $labels,
            'data' => $data
        ]);
    }

    public function academicYear(){
        
        $registrationsByYear = DB::table('registrations')
                                ->select(DB::raw("CONCAT(YEAR(tanggalRegistrasi), '-', YEAR(tanggalRegistrasi) + 1) AS academic_year"), DB::raw('COUNT(*) AS total_registrations'))
                                ->groupBy('academic_year') 
                                ->orderBy('academic_year') 
                                ->get(); 
    
        return response()->json($registrationsByYear);
    }

    public function topSchoolCities()
{
    // Query untuk menghitung jumlah pendaftar dari setiap kota asal sekolah
    

    return view('admin.analytic-admin', compact('kotaAsalSekolah'));
}
}
