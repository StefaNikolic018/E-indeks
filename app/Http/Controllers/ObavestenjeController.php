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
use App\Models\Smer;




class ObavestenjeController extends Controller
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
        $obavestenja=Obavestenje::all()->sortBy('odobrenje');
        foreach($obavestenja as $obavestenje){
            if($obavestenje->smer != 'svi'){
                $obavestenje->smer=Smer::where('id',$obavestenje->smer)->pluck('naziv')->first();
            }
        }
        if(Auth::user()->role=='admin'){
            return view('profesori.obavestenja.obavestenja',['obavestenja'=>$obavestenja]);
        }
        return view('admin.obavestenja.obavestenja',['obavestenja'=>$obavestenja]);
    }

    /**
     * Shows the adding students panel
     */
    public function novo_obavestenje(Request $req){
        if($req->method()=='GET'){
            $smerovi=Smer::all();
            if(Auth::user()->role=='admin'){
                return view('profesori.obavestenja.novo_obavestenje',['smerovi'=>$smerovi]);
            }
            return view('admin.obavestenja.novo_obavestenje',['smerovi'=>$smerovi]);
        }
        $input=['naslov'=>$req->naslov,'obavestenje'=>$req->obavestenje,'potpis'=>Auth::user()->role,'datum'=>$req->datum,'odobrenje'=>0,'smer'=>$req->smer];
        // Validator
        $validator=Validator::make($input,[
            'naslov'=>'required|max:50',
            'obavestenje'=>'required',
            'potpis'=>['required','regex:/admin|superAdmin/'],
            'datum'=>['required','date','before_or_equal:today'],
            'smer'=>'required'
        ]);
        // Ako polja nisu validna
        if($validator->fails()){
            return back()->withErrors($validator)->withInput();
        }
        // Ako jesu
        Obavestenje::create($input);
        $req->session()->flash('obavestenje',['success','Uspešno dodato obaveštenje!']);
        if(Auth::user()->role=='admin'){
            return redirect()->route('sva');
        }
        return redirect()->route('obavestenja');
        }


    /**
     * Shows individual student
     */
    public function obavestenje($id){
        $obavestenje=Obavestenje::find($id);
        $smer = ($obavestenje->smer!='svi') ? Smer::where('id',$obavestenje->smer)->pluck('naziv')->first() : 'Svi';
        if(Auth::user()->role=='admin'){
            return view('profesori.obavestenja.obavestenje',['obavestenje'=>$obavestenje,'smer'=>$smer]);
        }
        return view('admin.obavestenja.obavestenje',['obavestenje'=>$obavestenje,'smer'=>$smer]);
    }

    /**
     * Updating students info
     */
    public function izmena_obavestenja($id,Request $req){
        if($req->method()=='GET'){
            $obavestenje=Obavestenje::find($id);
            $smerovi=Smer::all();
            if(Auth::user()->role=='admin'){
                return view('profesori.obavestenja.izmena_obavestenja',['obavestenje'=>$obavestenje,'smerovi'=>$smerovi]);
            }
            return view('admin.obavestenja.izmena_obavestenja',['obavestenje'=>$obavestenje,'smerovi'=>$smerovi]);
        }
        $input=['naslov'=>$req->naslov,'obavestenje'=>$req->obavestenje,'potpis'=>Auth::user()->role,'datum'=>$req->datum,'odobrenje'=>0,'smer'=>$req->smer];
        // Validator
        $validator=Validator::make($input,[
            'naslov'=>'required|max:50',
            'obavestenje'=>'required',
            'potpis'=>['required','regex:/admin|superAdmin/'],
            'datum'=>['required','date','before_or_equal:today'],
            'smer'=>'required'
        ]);
        // Ako polja nisu validna
        if($validator->fails()){
            return back()->withErrors($validator)->withInput();
        }
        // Ako jesu
        Obavestenje::where('id',$id)->update($input);

        $req->session()->flash('obavestenje',['success','Uspešno izmenjeno obavestenje!']);
        if(Auth::user()->role=='admin'){
            return redirect()->route('profesorsko_obavestenje',['id'=>$id]);
        }

        return redirect()->route('obavestenje',['id'=>$id]);
    }

    /**
     * Deleting the student
     */
    public function brisanje_obavestenja($id, Request $req){
        Obavestenje::where('id',$id)->delete();
        $req->session()->flash('obavestenje',['success','Uspešno izbrisano obavestenje!']);
        if(Auth::user()->role=='admin'){
            return redirect()->route('sva');
        }
        return redirect()->route('obavestenja');
    }

    public function odobrenje_obavestenja($id,$odobrenje,Request $req){
        $input=['odobrenje'=>$odobrenje];
        Obavestenje::where('id',$id)->update($input);
        if($odobrenje==1){
            $req->session()->flash('obavestenje',['success','Uspešno odobreno obaveštenje!']);
            return redirect()->route('obavestenja');
        }
        $req->session()->flash('obavestenje',['success','Uspešno neodobreno obaveštenje!']);
        return redirect()->route('obavestenja');

    }

    public static function brojObavestenja(){
        return Obavestenje::where('odobrenje',0)->count();
    }
}
