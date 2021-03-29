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
use App\Models\Raspored;




class StudentController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth','can:isUser']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $req,$ime)
    {
        // TREBA MI DA BUDE PROFIL KROZ IME STUDENTA A NE KROZ ID KORISNIKA U WEB RUTAMA
        if(Student::where('ime',$ime)->first()){
            $email=Auth::user()->email;
            $stud=Student::where('email',$email)->first();
            $pred=Predmet::all();
            $ocen=Ocena::all();
            $obavestenja=Obavestenje::where('smer',$stud->smer)->orWhere('smer', 'svi')->orderBy('datum','desc')->get();
            $obavestenja=$obavestenja->where('odobrenje','1');

            return view('studenti.profil',['student'=>$stud,'predmeti'=>$pred,'ocene'=>$ocen,'obavestenja'=>$obavestenja]);
        } else {
            $email=Auth::user()->email;
            $ime=Student::where('email',$email)->value('ime');
            return redirect()->route('profil',['ime'=>$ime]);
        }
    }

    public function raspored(Request $req){
        $student=Student::where('email',Auth::user()->email)->first();
        $raspored=Raspored::where(['smer'=>$student->smer,'godina_studija'=>$student->godina_studija])->get();
        $raspored=$this->rastaviNiz($raspored);
        $raspored1=Raspored::where(['smer'=>$student->smer,'godina_studija'=>$student->godina_studija])->first();
        foreach($raspored as $raspored){
            $raspored1->ponedeljak=$raspored->ponedeljak;
            $raspored1->utorak=$raspored->utorak;
            $raspored1->sreda=$raspored->sreda;
            $raspored1->cetvrtak=$raspored->cetvrtak;
            $raspored1->petak=$raspored->petak;
        }
        // dd($raspored1->petak[0]);
        $predmeti=Predmet::all();

        return view('admin.raspored_predavanja.jedan',['raspored'=>$raspored1,'predmeti'=>$predmeti]);
    }


    // Kreiramo niz vrednosti iz forme za raspored casova
    private function rastaviNiz($rasporedi){
        $week=['ponedeljak','utorak','sreda','cetvrtak','petak'];
        foreach($rasporedi as $raspored){
            foreach($week as $dan){
                $raspored1=[];
                if($raspored->$dan!='Nema predavanja' || $raspored->$dan!=''){
                    if(strpos($raspored->$dan,'.')!=false){

                        $casovi=explode('.',$raspored->$dan);
                        foreach($casovi as $cas){
                            $cas1=explode(',',$cas);
                            foreach($cas1 as $cas2 ){
                                array_push($raspored1,$cas2);
                            }
                        }
                        $raspored->$dan=$raspored1;


                    } else {
                        $cas1=explode(',',$raspored->$dan);
                        $raspored->$dan=$cas1;
                    }

                } else {
                    $raspored->$dan='Nema predavanja';
                }
            }
        }
        return $rasporedi;
    }
}
