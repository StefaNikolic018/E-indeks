<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;
use App\Models\Predmet;
use App\Models\Student;
use App\Models\Ocena;
use App\Models\Smer;


class PredmetController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $predmet=Predmet::all();
        return view('admin.predmeti.predmeti',['predmeti'=>$predmet]);
    }

    public function novi_predmet(Request $req)
    {
        // Ako pristupamo stranici
        if($req->method()=='GET')
        {
            $smerovi=Smer::all();
            return view('admin.predmeti.novi_predmet',['smerovi'=>$smerovi]);
        }
        // Ako unosimo podatke
        $input=['sifra'=>$req->sifra,'naziv'=>$req->naziv,'godina_studija'=>$req->godina_studija,'espb'=>$req->espb,'obavezni_izborni'=>$req->obavezni_izborni,'smerovi'=>$req->smer];
        // Validator
        $validator=Validator::make($input,[
            'sifra'=>['required','max:10',
            'regex:/^([A-Z]+[0-9]+)/',"unique:predmeti,sifra"],
            'naziv'=>'required',
            'espb'=>'required|digits:1',
            'godina_studija'=>'required|numeric|digits:1',
            'obavezni_izborni'=>'required',
            'smerovi'=>'required'
        ]);
        // Ako polja nisu validna
        if($validator->fails()){
            return back()->withErrors($validator)->withInput();
        }
        // Ako jesu
        Predmet::create($input);
        // $predmeti=Smer::where('id',$req->smer)->pluck('predmeti');
        // if(strpos($predmeti,',') !== false){
        //     $predmeti=$predmeti.','.$req->naziv;
        //     $predmeti=['predmeti'=>$predmeti];
        //     Smer::where('id',$req->smer)->update($predmeti);
        // } else {
        //     $predmeti=['predmeti'=>$req->naziv];
        //     Smer::where('id',$req->smer)->update($predmeti);
        // }


        $req->session()->flash('predmet',['success','Uspešno dodat predmet '.$req->naziv.'!']);
        return redirect()->route('predmeti');

    }

    public function izmena_predmeta($id, Request $req)
    {
        // Ako zelimo da pristupimo stranici
        if($req->method()=='GET')
        {
            $smerovi=Smer::all();
            $predmet=Predmet::where('id',$id)->first();
            return view('admin.predmeti.izmena_predmeta',['predmet'=>$predmet,'smerovi'=>$smerovi]);
        }
        // Ako unosimo podatke
        $input=['sifra'=>$req->sifra,'naziv'=>$req->naziv,'godina_studija'=>$req->godina_studija,'espb'=>$req->espb,'obavezni_izborni'=>$req->obavezni_izborni,'smerovi'=>$req->smer];

        // Validator
        $validator=Validator::make($input,[
            'sifra'=>['required','max:10',
            'regex:/^([A-Z]+[0-9]+)/',"unique:predmeti,sifra,{$id}"],
            'naziv'=>'required',
            'espb'=>'required|digits:1',
            'godina_studija'=>'required|numeric|digits:1',
            'obavezni_izborni'=>'required',
            'smerovi'=>'required'
        ]);
        // Ako polja nisu validna
        if($validator->fails()){
            // dump($validator);
            return back()->withErrors($validator)->withInput();
        }
        $predmet=Predmet::find($id);
        $st_id=Ocena::where('predmet_id',$id)->pluck('student_id');
        foreach($st_id as $id1){
            $student=Student::find($id1);
            $espb=$student->espb-$predmet->espb+$input['espb'];
            $student->update(['espb'=>$espb]);
        }
        $predmet->update($input);

        $req->session()->flash('predmet',['success','Uspešno izmenjen predmet '.$req->naziv.'!']);
        return redirect()->route('predmeti');
    }

    public function kopiranje_predmeta($id, Request $req)
    {
        // Ako zelimo da pristupimo stranici
        if($req->method()=='GET')
        {
            $predmet=Predmet::find($id);
            $smerovi=Smer::where('id','!=',$predmet->smerovi)->get();
            return view('admin.predmeti.kopiranje_predmeta',['predmet'=>$predmet,'smerovi'=>$smerovi]);
        }
        $predmet=Predmet::find($id);

        // Ako unosimo podatke
        $input=['sifra'=>$req->sifra,'naziv'=>$predmet->naziv,'godina_studija'=>$req->godina_studija,'espb'=>$req->espb,'obavezni_izborni'=>$req->obavezni_izborni,'smerovi'=>$req->smer];

        // Validator
        $validator=Validator::make($input,[
            'sifra'=>['required','max:10',
            'regex:/^([A-Z]+[0-9]+)/',"unique:predmeti,sifra"],
            'espb'=>'required|digits:1',
            'godina_studija'=>'required|numeric|digits:1',
            'obavezni_izborni'=>'required',
            'smerovi'=>'required'
        ]);
        // Ako polja nisu validna
        if($validator->fails()){
            return back()->withErrors($validator)->withInput();
        }

        Predmet::create($input);

        $req->session()->flash('predmet',['success','Uspešno kopiran predmet '.$req->naziv.'!']);
        return redirect()->route('predmeti');
    }

    public function brisanje_predmeta($id,Request $req){
        $st_id=Ocena::select('student_id')->where('predmet_id',$id)->get();
// TODO: Resiti konflikte izmedju trigera i kverija, tj. resiti problem ovde umesto u trigeru, jer ne moze od jednom da apdejtuje vise studenata u jednom trigeru -> RESENO
        // Nalazimo predmet
        $predmet=Predmet::find($id);
        $predmet->delete();

        foreach($st_id as $id1){
            $student=Student::find($id1->student_id);
            $espb=$student->espb-$predmet->espb;
            $ocena=Ocena::where('student_id',$id1->student_id)->avg('ocena');
            $student->update(['prosek_ocena'=>$ocena,'espb'=>$espb]);
        }

        $req->session()->flash('predmet',['success','Uspešno izbrisan predmet!']);
        return redirect()->route('predmeti');


    }
}
