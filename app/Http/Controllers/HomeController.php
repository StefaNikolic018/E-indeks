<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;


use App\Models\Student;
use App\Models\Predmet;
use App\Models\Ocena;
use App\Models\User;
use App\Models\Smer;
use App\Models\Profesor;





class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $req)
    {
        $stud=Student::all();
        if(Auth::user()->role=='admin'){
            return view('profesori.studenti.studenti',['stud'=>$stud]);
        }
        return view('admin.studenti.studenti',['stud'=>$stud]);
    }

    /**
     * Shows the adding students panel
     */
    public function novi_student(Request $req){
        if($req->method()=='GET'){
            $smerovi=Smer::all();
            if(Student::count()==0){
                $emails=User::select('email')->where('role','user')->get();
            } else if(Student::count()==User::where('role','user')->count()){
                $emails=[];
            } else {
                $emails=[];
                $korisnici=User::where('role','user')->get();
                $studenti=Student::all();
                $k_email=[];
                $s_email=[];
                foreach($korisnici as $korisnik){
                    array_push($k_email,$korisnik->email);
                }
                foreach($studenti as $student){
                        array_push($s_email,$student->email);
                }
                $emails=array_diff($k_email,$s_email);
                // $emails=User::rightJoin('studenti','studenti.email','!=','users.email')->where('users.email','!=','studenti.email')->where('users.role','user')->get(['users.email']);
            }
            return view('admin.studenti.novi_student',['emails'=>$emails,'smerovi'=>$smerovi]);
        }
        $input=['ime'=>$req->ime,'prezime'=>$req->prezime,'ime_roditelja'=>$req->ime_roditelja,'broj_indeksa'=>$req->broj_indeksa,'email'=>$req->email,'broj_telefona'=>$req->broj_telefona,'godina_studija'=>$req->godina_studija,'datum_rodjenja'=>$req->datum_rodjenja,'jmbg'=>$req->jmbg,'smer'=>$req->smer];
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
            'smer'=>['required','exists:smerovi,id']
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
        $stud=Student::find($id);
        $predmeti=$stud->smers->predmeti;
        $ocene=Ocena::all();
        $predmeti_id=Ocena::where('student_id',$id)->pluck('predmet_id')->toArray();
        $predmeti=$predmeti->whereNotIn('id',$predmeti_id);
        if(Auth::user()->role=='admin'){
            $profesor=Profesor::where('email_korisnika',Auth::user()->email)->first();
            $pred=explode(',',$profesor->predmeti);
            return view('profesori.studenti.student',['student'=>$stud,'predmeti'=>$predmeti,'ocene'=>$ocene,'pred'=>$pred]);
        }
        return view('admin.studenti.student',['student'=>$stud,'predmeti'=>$predmeti,'ocene'=>$ocene]);

    }

    // MORA DA URADIM RELATIONSHIPS ZA SVE MODELE ZA KOJE NISAM,
    // PRVO ZA STUDENTA DA BIH MOGAO DA VUCEM INFORMACIJE SMERA,
    // ZATIM ZA SVE OSTALO

    /**
     * Updating students info
     */
    public function izmena_studenta($id,Request $req){
        if($req->method()=='GET'){
            $stud=Student::where('id',$id)->first();
            $smerovi=Smer::all();
            return view('admin.studenti.izmena_studenta',['student'=>$stud,'smerovi'=>$smerovi]);
        }
        $input=['ime'=>$req->ime,'prezime'=>$req->prezime,'ime_roditelja'=>$req->ime_roditelja,'broj_indeksa'=>$req->broj_indeksa,'email'=>$req->email,'broj_telefona'=>$req->broj_telefona,'godina_studija'=>$req->godina_studija,'datum_rodjenja'=>$req->datum_rodjenja,'jmbg'=>$req->jmbg,'smer'=>$req->smer];
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
