<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Ocena;
use App\Models\Student;
use App\Models\Predmet;
use App\Models\User;

class OcenaController extends Controller
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
        return view('ocene');
    }

    /**
     * Adding grade to the table and inserting it in students table
     */
    public function dodaj_ocenu($id, Request $req){

        $student_predmet=$id.$req->izbor;
        $input=['datum'=>$req->datum,'ocena'=>$req->ocena,
        'predmet_id'=>$req->izbor,'student_id'=>$id,'student_predmet'=>$student_predmet];
        $validator=Validator::make($input,[
            'datum'=>['required','date','before_or_equal:today'],
            'ocena'=>['required','min:6','max:10','numeric'],
            'predmet_id'=>['required','numeric'],
            'student_id'=>['required','numeric'],
            'student_predmet'=>['required','unique:ocene,student_predmet']
        ]);
        if($validator->fails()){
            return back()->withErrors($validator)->withInput();
        }

        Ocena::create($input);

        $espb=Predmet::select('espb')->where('id',$req->izbor)->first();

        Student::where('id',$id)->increment('espb',$espb->espb);

        $ocena=Ocena::where('student_id',$id)->avg('ocena');
        Student::where('id',$id)->update(['prosek_ocena'=>$ocena]);

        $req->session()->flash('student',['success','Uspešno dodata ocena!']);
        return redirect()->route('student',$id);
    }

    /**
     * Deleting a grade
     */
    public function ocena_brisanje($oc_id,$st_id,Request $req){


        Ocena::where('id',$oc_id)->delete();

        $ocena=Ocena::where('student_id',$st_id)->avg('ocena');
        if($ocena){
            Student::where('id',$st_id)->update(['prosek_ocena'=>$ocena]);
        } else {
            Student::where('id',$st_id)->update(['prosek_ocena'=>0.00]);
        }
        $req->session()->flash('student',['success','Uspešno obrisana ocena!']);
        return redirect()->route('student',$st_id);


    }

    public function ocena_izmena($oc_id,$st_id, Request $req){
        if($req->method()=='GET'){

            $id=['oc_id'=>$oc_id,'st_id'=>$st_id];

            $ocena=Ocena::where('id',$oc_id)->first();

            $student=Student::where('id',$st_id)->value('ime');

            $predmeti=Predmet::where('id',$ocena->predmet_id)->first();
            return view('profesori.ocene.ocena_izmena',['predmeti'=>$predmeti,'ocena'=>$ocena,'id'=>$id,'ime'=>$student]);
        }
        $student_predmet=$st_id.$req->izbor;
        $input=['datum'=>$req->datum,'ocena'=>$req->ocena,
        'predmet_id'=>$req->izbor,'student_id'=>$st_id,'student_predmet'=>$student_predmet];


        $validator=Validator::make($input,[
            'datum'=>['required','date','before_or_equal:today'],
            'ocena'=>['required','min:6','max:10','numeric'],
            'predmet_id'=>['required','numeric'],
            'student_id'=>['required','numeric'],
            'student_predmet'=>['required',"unique:ocene,student_predmet,{$oc_id}"]
        ]);
        if($validator->fails()){
            return back()->withErrors($validator)->withInput();
        }


        Ocena::where('id',$oc_id)->update($input);

        // $espb=Predmet::select('espb')->where('id',$req->izbor)->first();

        // Student::where('id',$st_id)->update('espb',$espb->espb);

        $ocena=Ocena::where('student_id',$st_id)->avg('ocena');

        Student::where('id',$st_id)->update(['prosek_ocena'=>$ocena]);

        $req->session()->flash('student',['success','Uspešno izmenjena ocena!']);
        return redirect()->route('student',$st_id);


    }


}
