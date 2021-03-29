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

class ProfesorController extends Controller
{
    public function index(Request $req)
    {
        $profesori=Profesor::all();
        return view('admin.profesori.profesori',['profesori'=>$profesori]);
    }

     /**
     * Shows the adding students panel
     */
    public function novi_profesor(Request $req){
        if($req->method()=='GET'){
            $predmeti=Predmet::all();
            if(Profesor::count()==0){
                $emails=User::select('email')->where('role','admin')->get();
            } else if(Profesor::count()==User::where('role','admin')->count()){
                $emails=[];
            } else {
                $emails=User::rightJoin('profesori','profesori.email_korisnika','!=','users.email')->where('users.email','!=','profesori.email_korisnika')->where('users.role','admin')->get(['users.email']);
            }

            return view('admin.profesori.novi_profesor',['emails'=>$emails,'predmeti'=>$predmeti]);
        }
        $input=['ime'=>$req->ime,'prezime'=>$req->prezime,'zvanje'=>$req->zvanje,'email_korisnika'=>$req->email_korisnika,'datum_zaposljenja'=>$req->datum_zaposljenja,'predmeti'=>implode(',',$req->predmeti),'datum_rodjenja'=>$req->datum_rodjenja,'bio'=>$req->bio];
        // Validator
        $validator=Validator::make($input,[
            'ime'=>'required|max:50',
            'prezime'=>'required|max:50',
            'zvanje'=>'required|max:50',
            'datum_zaposljenja'=>['required','integer'],
            'email_korisnika'=>['required','max:100','unique:profesori,email_korisnika'],
            'datum_rodjenja'=>['required','date'],
            'bio'=>['required'],
            'predmeti'=>['required']
        ]);
        // Ako polja nisu validna
        if($validator->fails()){
            return back()->withErrors($validator)->withInput();
        }
        // Ako jesu
        Profesor::create($input);
        $req->session()->flash('profesor',['success','Uspešno dodat profesor '.$req->ime.'!']);
        return redirect()->route('profesori');
        }


    /**
     * Shows individual student
     */
    public function profesor($id){
        if(Auth::user()->role=='admin'){
            $email=Auth::user()->email;
            $profesor=Profesor::where('email_korisnika',$email)->first();
        } else {
            $profesor=Profesor::find($id);
            if(!$profesor){
                return back();
            }
        }
        $pred=explode(',',$profesor->predmeti);
        $predmeti=[];
        for($i=0;$i<count($pred);$i++){
            $p=Predmet::where('naziv',$pred[$i])->get();
            $p=$p->toArray();
            array_push($predmeti,$p);
        }
        if(Profesor::where('ime',$id)->first()){
            // Ako je prosledjeno ime kao parametar
            return view('admin.profesori.profesor',['profesor'=>$profesor,'predmeti'=>$predmeti,'pred'=>$pred]);
        } else if(Profesor::find($id)){
            // Ako je prosledjen id kao parametar
            return view('admin.profesori.profesor',['profesor'=>$profesor,'predmeti'=>$predmeti,'pred'=>$pred]);
        } else {
            // Ako je pogresno ime
            return redirect()->route('profile',['ime'=>$profesor->ime]);
        }
    }

    /**
     * Updating students info
     */
    public function izmena_profesora($id,Request $req){
        if($req->method()=='GET'){
            $profesor=Profesor::find($id);
            $pred=explode(',',$profesor->predmeti);
            $predmeti=Predmet::all();
            return view('admin.profesori.izmena_profesora',['profesor'=>$profesor,'pred'=>$pred,'predmeti'=>$predmeti]);
        }
        $input=['ime'=>$req->ime,'prezime'=>$req->prezime,'zvanje'=>$req->zvanje,'email_korisnika'=>$req->email_korisnika,'datum_zaposljenja'=>$req->datum_zaposljenja,'predmeti'=>implode(',',$req->predmeti),'datum_rodjenja'=>$req->datum_rodjenja,'bio'=>$req->bio];
        // Validator
        $validator=Validator::make($input,[
            'ime'=>'required|max:50',
            'prezime'=>'required|max:50',
            'zvanje'=>'required|max:50',
            'datum_zaposljenja'=>['required','integer'],
            'email_korisnika'=>['required','max:100',"unique:profesori,email_korisnika, {$id}"],
            'datum_rodjenja'=>['required','date'],
            'bio'=>['required'],
            'predmeti'=>['required']
        ]);
        // Ako polja nisu validna
        if($validator->fails()){
            return back()->withErrors($validator)->withInput();
        }
        // Ako jesu
        Profesor::where('id',$id)->update($input);

        $req->session()->flash('profesor',['success','Uspešno izmenjen profesor '.$req->ime.'!']);

        return redirect()->route('profesor',['id'=>$id]);
    }

    /**
     * Deleting the student
     */
    public function brisanje_profesora($id, Request $req){
        Profesor::where('id',$id)->delete();
        $req->session()->flash('profesor',['success','Uspešno izbrisan profesor!']);
        return redirect()->route('profesori');
    }

}
