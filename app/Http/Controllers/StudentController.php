<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;


use App\Models\Student;
use App\Models\Predmet;
use App\Models\Ocena;
use App\Models\User;


class StudentController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth','can:isUser']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $req,$id)
    {
        // TREBA MI DA BUDE PROFIL KROZ IME STUDENTA A NE KROZ ID KORISNIKA U WEB RUTAMA

        $email=Auth::user()->email;
        $stud=Student::where('email',$email)->first();
        $pred=Predmet::all();
        $ocen=Ocena::all();

        return view('studenti.profil',['student'=>$stud,'predmeti'=>$pred,'ocene'=>$ocen]);
    }
}
