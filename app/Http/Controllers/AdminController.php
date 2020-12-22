<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;


use App\Models\Student;
use App\Models\Predmet;
use App\Models\Ocena;
use App\Models\User;
use App\Models\Obavestenje;
use App\Models\Profesor;



class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth','can:isSuperAdmin']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $req)
    {
        // TREBA MI DA BUDE PROFIL KROZ IME STUDENTA A NE KROZ ID KORISNIKA U WEB RUTAMA

        $korisnici=User::count();
        $pred=Predmet::count();
        $obavestenja=Obavestenje::count();
        $studenti=Student::count();
        $profesori=Profesor::count();
        $administratori=User::where('role','superadmin')->count();
        $godina1=Predmet::where('godina_studija',1)->count();
        $godina2=Predmet::where('godina_studija',2)->count();
        $godina3=Predmet::where('godina_studija',3)->count();
        $profesorObavestenja=Obavestenje::where('potpis','admin')->count();
        $adminObavestenja=Obavestenje::where('potpis','superAdmin')->count();
        $neodobrenaObavestenja=Obavestenje::where('odobrenje',0)->count();




        return view('admin.pocetna',['korisnici'=>$korisnici,'predmeti'=>$pred,'obavestenja'=>$obavestenja,'studenti'=>$studenti,'profesori'=>$profesori,'administratori'=>$administratori,'prva'=>$godina1,'druga'=>$godina2,'treca'=>$godina3,'prof'=>$profesorObavestenja,'admin'=>$adminObavestenja,'neodobrena'=>$neodobrenaObavestenja]);
    }


    }
