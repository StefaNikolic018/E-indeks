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
use App\Models\Smer;

class SmerController extends Controller
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

        $smerovi=Smer::all()->sortBy('espb');

        return view('admin.smerovi.smerovi',['smerovi'=>$smerovi]);
    }

    /**
     * Shows the adding students panel
     */
    public function novi_smer(Request $req){
        if($req->method()=='GET'){
            $predmeti=Predmet::all();
            return view('admin.smerovi.novi_smer',['predmeti'=>$predmeti]);
        }
        $input=['naziv'=>$req->naziv,'opis'=>$req->opis,'akreditovan'=>$req->akreditovan,'espb'=>180];
        // Validator
        $validator=Validator::make($input,[
            'naziv'=>'required|max:50',
            'opis'=>'required',
            'akreditovan'=>'required',
        ]);
        // Ako polja nisu validna
        if($validator->fails()){
            return back()->withErrors($validator)->withInput();
        }
        // Ako jesu
        Smer::create($input);
        $req->session()->flash('smer',['success','Uspešno dodat smer!']);
        return redirect()->route('smerovi');
        }


    /**
     * Shows individual student
     */
    public function smer($id){
        $smer=Smer::find($id);

        return view('admin.smerovi.smer',['smer'=>$smer]);

    }

    /**
     * Updating students info
     */
    public function izmena_smera($id,Request $req){
        if($req->method()=='GET'){
            $smer=Smer::find($id);
            return view('admin.smerovi.izmena_smera',['smer'=>$smer]);
        }
        $input=['naziv'=>$req->naziv,'opis'=>$req->opis,'akreditovan'=>$req->akreditovan,'espb'=>180];
        // Validator
        $validator=Validator::make($input,[
            'naziv'=>'required|max:50',
            'opis'=>'required',
            'akreditovan'=>'required',
            'espb'=>'required',
        ]);
        // Ako polja nisu validna
        if($validator->fails()){
            return back()->withErrors($validator)->withInput();
        }
        // Ako jesu
        Smer::where('id',$id)->update($input);

        $req->session()->flash('smer',['success','Uspešno izmenjen smer!']);

        return redirect()->route('smer',['id'=>$id]);
    }

    /**
     * Deleting the student
     */
    public function brisanje_smera($id, Request $req){
        Obavestenje::where('smer',$id)->delete();
        Smer::find($id)->delete();
        $req->session()->flash('smer',['success','Uspešno izbrisan smer!']);
        return redirect()->route('smerovi');
    }
}
