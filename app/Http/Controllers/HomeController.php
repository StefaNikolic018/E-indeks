<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Models\Student;
use App\Models\Predmet;
use App\Models\Ocena;
use App\Models\User;



class HomeController extends Controller
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
        $stud=Student::all();
        return view('admin.studenti.studenti',['stud'=>$stud]);
    }

    /**
     * Shows the adding students panel
     */
    public function novi_student(Request $req){
        if($req->method()=='GET'){
            $emails=User::join('studenti','studenti.email','!=','users.email')->where('users.role','user')->get(['users.email']);
            return view('admin.studenti.novi_student',['emails'=>$emails]);
        }
        $input=['ime'=>$req->ime,'prezime'=>$req->prezime,'ime_roditelja'=>$req->ime_roditelja,'broj_indeksa'=>$req->broj_indeksa,'email'=>$req->email,'broj_telefona'=>$req->broj_telefona,'godina_studija'=>$req->godina_studija,'datum_rodjenja'=>$req->datum_rodjenja,'jmbg'=>$req->jmbg];
        // Validator
        $validator=Validator::make($input,[
            'ime'=>'required|max:50',
            'prezime'=>'required|max:50',
            'ime_roditelja'=>'required|max:50',
            'broj_indeksa'=>['required','regex:/^REr|SEr/',"unique:studenti,broj_indeksa"],
            'email'=>['required','max:100','unique:studenti,email'],
            'broj_telefona'=>'required|min:10|max:13',
            'godina_studija'=>'required|numeric|digits:1',
            'datum_rodjenja'=>['required','date','before_or_equal:2002-12-31'],
            'jmbg'=>['required','numeric','digits:12',"unique:studenti,jmbg"],
        ]);
        // Ako polja nisu validna
        if($validator->fails()){
            return back()->withErrors($validator)->withInput();
        }
        // Ako jesu
        Student::create($input);
        $req->session()->flash('student',['success','Uspešno dodat student '.$req->ime.'!']);
        return redirect()->route('studenti');
        }


    /**
     * Shows individual student
     */
    public function student($id){
        $stud=Student::where('id',$id)->first();
        $predmeti=Predmet::all();
        $ocene=Ocena::all();
        return view('admin.studenti.student',['student'=>$stud,'predmeti'=>$predmeti,'ocene'=>$ocene]);

    }

    /**
     * Updating students info
     */
    public function izmena_studenta($id,Request $req){
        if($req->method()=='GET'){
            $stud=Student::where('id',$id)->first();
            return view('admin.studenti.izmena_studenta',['student'=>$stud]);
        }
        $input=['ime'=>$req->ime,'prezime'=>$req->prezime,'ime_roditelja'=>$req->ime_roditelja,'broj_indeksa'=>$req->broj_indeksa,'email'=>$req->email,'broj_telefona'=>$req->broj_telefona,'godina_studija'=>$req->godina_studija,'datum_rodjenja'=>$req->datum_rodjenja,'jmbg'=>$req->jmbg];
        // Validator
        $validator=Validator::make($input,[
            'ime'=>'required|max:50',
            'prezime'=>'required|max:50',
            'ime_roditelja'=>'required|max:50',
            'broj_indeksa'=>['required','regex:/^REr|SEr/',"unique:studenti,broj_indeksa,{$id}"],
            'email'=>['required','max:100',"unique:studenti,email,{$id}"],
            'broj_telefona'=>'required|min:10|max:13',
            'godina_studija'=>'required|numeric|digits:1',
            'datum_rodjenja'=>['required','date','before_or_equal:2002-12-31'],
            'jmbg'=>'required|numeric|digits:12',
        ]);
        // Ako polja nisu validna
        if($validator->fails()){
            return back()->withErrors($validator)->withInput();
        }
        // Ako jesu
        Student::where('id',$id)->update($input);

        $req->session()->flash('student',['success','Uspešno izmenjen student '.$req->ime.'!']);

        return redirect()->route('student',['id'=>$id]);
    }

    /**
     * Deleting the student
     */
    public function brisanje_studenta($id, Request $req){
        Student::where('id',$id)->delete();
        $req->session()->flash('student',['success','Uspešno izbrisan student!']);
        return redirect()->route('studenti');
    }
}
