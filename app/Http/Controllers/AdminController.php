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

        return view('admin.pocetna',['korisnici'=>$korisnici,'predmeti'=>$pred,'obavestenja'=>$obavestenja]);
    }
    }
