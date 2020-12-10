<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;
use App\Models\Predmet;
use App\Models\Student;
use App\Models\Ocena;

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
            return view('admin.predmeti.novi_predmet');
        }
        // Ako unosimo podatke
        $input=['sifra'=>$req->sifra,'naziv'=>$req->naziv,'godina_studija'=>$req->godina_studija,'espb'=>$req->espb,'obavezni_izborni'=>$req->obavezni_izborni];
        // Validator
        $validator=Validator::make($input,[
            'sifra'=>['required','max:10',
            'regex:/^([A-Z]+[0-9]+)/',"unique:predmeti,sifra"],
            'naziv'=>'required',
            'espb'=>'required|digits:1',
            'godina_studija'=>'required|numeric|digits:1',
            'obavezni_izborni'=>'required',
        ]);
        // Ako polja nisu validna
        if($validator->fails()){
            return back()->withErrors($validator)->withInput();
        }
        // Ako jesu
        Predmet::create($input);

        $req->session()->flash('predmet',['success','Uspešno dodat predmet '.$req->naziv.'!']);
        return redirect()->route('predmeti');

    }

    public function izmena_predmeta($id, Request $req)
    {
        // Ako zelimo da pristupimo stranici
        if($req->method()=='GET')
        {
            $predmet=Predmet::where('id',$id)->first();
            return view('admin.predmeti.izmena_predmeta',['predmet'=>$predmet]);
        }
        // Ako unosimo podatke
        $input=['sifra'=>$req->sifra,'naziv'=>$req->naziv,'godina_studija'=>$req->godina_studija,'espb'=>$req->espb,'obavezni_izborni'=>$req->obavezni_izborni];

        // Validator
        $validator=Validator::make($input,[
            'sifra'=>['required','max:10',
            'regex:/^([A-Z]+[0-9]+)/',"unique:predmeti,sifra,{$id}"],
            'naziv'=>'required',
            'espb'=>'required|digits:1',
            'godina_studija'=>'required|numeric|digits:1',
            'obavezni_izborni'=>'required',
        ]);
        // Ako polja nisu validna
        if($validator->fails()){
            return back()->withErrors($validator)->withInput();
        }

        Predmet::where('id',$id)->update($input);

        $req->session()->flash('predmet',['success','Uspešno izmenjen predmet '.$req->naziv.'!']);
        return redirect()->route('predmeti');
    }

    public function brisanje_predmeta($id,Request $req){
        $st_id=Ocena::select('student_id')->where('predmet_id',$id)->get();

        Predmet::where('id',$id)->delete();

        foreach($st_id as $id1){
            $ocena=Ocena::where('student_id',$id1->student_id)->avg('ocena');
            Student::where('id',$id1->student_id)->update(['prosek_ocena'=>$ocena]);
        }


        $req->session()->flash('predmet',['success','Uspešno izbrisan predmet!']);
        return redirect()->route('predmeti');


    }
}
