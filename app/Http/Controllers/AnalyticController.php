<?php

namespace App\Http\Controllers;

use App\Models\PivotAdminUser;
use Carbon\Carbon;

use App\Models\User;

use Illuminate\Http\Request;

class AnalyticController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.analytic-admin');
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
            // Retrieve the number of registrations for each day
            $registrations = User::whereDate('created_at', $date)->count();
            // Add the date as label
            $labels[] = $date->format('(D) d/m');
            // Add the number of registrations for the day
            $data[] = $registrations;
        }

        return response()->json([
            'labels' => $labels,
            'data' => $data
        ]);
    }
}
