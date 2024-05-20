<?php

namespace App\Http\Controllers;

use App\Models\Survey;
use App\Models\Answer;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class SurveyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $survey = Survey::first();
        $user = Auth::user();
        

        if ($user && $user->role === 'admin') {
            $answer= Answer::all();
            if ($survey) {
                return view('admin.survey-admin', compact('survey','answer'));
            } else {
                return redirect()->route('admin.survey.create')->with('message', 'Survey belum ada, anda harus membuat survey terlebih dahulu untuk memasukkan pertanyaan.');
            }
        } elseif ($user && $user->role === 'user') {
            $answer= Answer::where('user_id',$user->id)->get()->last();
            if ($survey) {
                
                if($answer){
                    return view('user.surveyAnswered-user',compact('answer'));
                } else {
                    return view('user.survey-user', compact('survey'));
                }
                
            } else {
                return view('user.surveyEmpty-user')->with('message', 'Belum ada survey saat ini, silahkan lanjutkan pendaftaran anda');
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
        return view('admin.tambahSurvey-admin');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'pertanyaan1' => 'required|string|max:255',

        ]);

        if (Survey::count() > 0) {

            $survey = Survey::first();
            $survey->update($request->only('pertanyaan1', 'pertanyaan2', 'pertanyaan3'));
        } else {
            Survey::create($request->only('pertanyaan1', 'pertanyaan2', 'pertanyaan3'));
        }
        return redirect()->route('admin.index')->with('success', 'Survey berhasil dibuat');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $answer = Answer::where('user_id', auth()->user()->id)->first();
        $message = "";

        if ($answer) {
            $message = "Terima kasih anda telah mengisi survey";
        }

        return view('user.survey', compact('answer'));
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
        $survey = Survey::findOrFail($id);
        $survey->update($request->all());

        return redirect()->route('admin.survey.index')->with('success', 'Survey berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $survey = Survey::findOrFail($id);
        $survey->delete();

        return redirect()->route('admin.survey.index')->with('success', 'Survei berhasil dihapus');
    }
}
