<?php

namespace App\Http\Controllers;
use App\Models\Answer;
use App\Models\User;
use App\Models\Survey;

use Illuminate\Http\Request;

class AnswerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $answer = Answer::all();
        return view ('admin.survey-admin',compact('answer'));
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
        
        $answer = new Answer();
        $answer->user_id = auth()->user()->id;
        $firstSurveyId = Survey::orderBy('id')->value('id');
        $answer->survey_id = $firstSurveyId;
        $answer->jawabanPertanyaan1 = $request->input('jawabanPertanyaan1');
        $answer->jawabanPertanyaan2 = $request->input('jawabanPertanyaan2');
        $answer->jawabanPertanyaan3 = $request->input('jawabanPertanyaan3');
        $answer->save();
        return redirect()->back()->with('success', 'Jawaban berhasil disimpan.');

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
