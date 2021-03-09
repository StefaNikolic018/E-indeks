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
use App\Models\Smer;

class RasporedController extends Controller
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
        $rasporedi=Raspored::all();
        $rasporedi=$this->rastaviNiz($rasporedi);

        return view('admin.raspored_predavanja.raspored',['rasporedi'=>$rasporedi]);
    }



    /**
     * Shows the adding students panel
     */
    public function novi_raspored(Request $req){
        if($req->method()=='GET'){
            $predmeti=Predmet::all();
            $smerovi = Smer::all();
            return view('admin.raspored_predavanja.novi_raspored',['smerovi'=>$smerovi,'predmeti'=>$predmeti]);
        }
        $ponedeljak=$req->ponedeljak;
        $pon=$this->kreirajNiz($ponedeljak,'Ponedeljak','',$req);
        $utorak=$req->utorak;
        $uto=$this->kreirajNiz($utorak,'Utorak','',$req);
        $sreda=$req->sreda;
        $sre=$this->kreirajNiz($sreda,'Sreda','',$req);
        $cetvrtak=$req->cetvrtak;
        $cet=$this->kreirajNiz($cetvrtak,'Četvrtak','',$req);
        $petak=$req->petak;
        $pet=$this->kreirajNiz($petak,'Petak','',$req);


        $input=['smer'=>$req->smer,'godina_studija'=>$req->godina_studija,'ponedeljak'=>$pon,'utorak'=>$uto,'sreda'=>$sre,'cetvrtak'=>$cet,'petak'=>$pet];


        // Validator
        $validator=Validator::make($input,[
            'smer'=>'required',
            'godina_studija'=>'required|numeric',
        ]);
        // Ako polja nisu validna
        if($validator->fails()){
            return back()->withErrors($validator)->withInput();
        }
        // Ako jesu
        Raspored::create($input);
        $req->session()->flash('raspored',['success','Uspešno dodat raspored!']);
        return redirect()->route('raspored');
        }


    /**
     * Shows individual student
     */
    public function raspored($id){
        $raspored=Raspored::where('id',$id)->get();
        $raspored=$this->rastaviNiz($raspored);
        $raspored1=Raspored::find($id);
        foreach($raspored as $raspored){
            $raspored1->ponedeljak=$raspored->ponedeljak;
            $raspored1->utorak=$raspored->utorak;
            $raspored1->sreda=$raspored->sreda;
            $raspored1->cetvrtak=$raspored->cetvrtak;
            $raspored1->petak=$raspored->petak;

        }

        // dd($raspored);

        return view('admin.raspored_predavanja.jedan',['raspored'=>$raspored1]);

    }

    /**
     * Updating students info
     */
    // TODO
    public function izmena_rasporeda($id,Request $req){
        if($req->method()=='GET'){
            $raspored=Raspored::where('id',$id)->get();
            $raspored=$this->rastaviNiz($raspored);
            $raspored1=Raspored::find($id);
            foreach($raspored as $raspored){
                $raspored1->ponedeljak=$raspored->ponedeljak;
                $raspored1->utorak=$raspored->utorak;
                $raspored1->sreda=$raspored->sreda;
                $raspored1->cetvrtak=$raspored->cetvrtak;
                $raspored1->petak=$raspored->petak;

            }
            if($raspored1->ponedeljak!='Nema predavanja'){
                $pon=count($raspored1->ponedeljak)/4;
            } else {
                $pon=0;
            }
            if($raspored1->utorak!='Nema predavanja'){
                $uto=count($raspored1->utorak)/4;
            } else {
                $uto=0;
            }
            if($raspored1->sreda!='Nema predavanja'){
                $sre=count($raspored1->sreda)/4;
            } else {
                $sre=0;
            }
            if($raspored1->cetvrtak!='Nema predavanja'){
                $cet=count($raspored1->cetvrtak)/4;
            } else {
                $cet=0;
            }
            if($raspored1->petak!='Nema predavanja'){
                $pet=count($raspored1->petak)/4;
            } else {
                $pet=0;
            }


            $predmeti=Predmet::all();
            return view('admin.raspored_predavanja.izmena_rasporeda',['raspored'=>$raspored1,'predmeti'=>$predmeti,'pon'=>$pon,'uto'=>$uto,'sre'=>$sre,'cet'=>$cet,'pet'=>$pet]);
        }
        $ponedeljak=$req->ponedeljak;
        $pon=$this->kreirajNiz($ponedeljak,'Ponedeljak','',$req);
        $utorak=$req->utorak;
        $uto=$this->kreirajNiz($utorak,'Utorak','',$req);
        $sreda=$req->sreda;
        $sre=$this->kreirajNiz($sreda,'Sreda','',$req);
        $cetvrtak=$req->cetvrtak;
        $cet=$this->kreirajNiz($cetvrtak,'Četvrtak','',$req);
        $petak=$req->petak;
        $pet=$this->kreirajNiz($petak,'Petak','',$req);


        $input=['smer'=>$req->smer,'godina_studija'=>$req->godina_studija,'ponedeljak'=>$pon,'utorak'=>$uto,'sreda'=>$sre,'cetvrtak'=>$cet,'petak'=>$pet];


        // Validator
        $validator=Validator::make($input,[
            'smer'=>'required',
            'godina_studija'=>'required|numeric',
        ]);
        // Ako polja nisu validna
        if($validator->fails()){
            return back()->withErrors($validator)->withInput();
        }
        // Ako jesu
        Raspored::where('id',$id)->update($input);
        $req->session()->flash('raspored',['success','Uspešno izmenjen raspored!']);
        return redirect()->route('raspored');
    }

    /**
     * Deleting the student
     */
    public function brisanje_rasporeda($id, Request $req){
        Raspored::where('id',$id)->delete();
        $req->session()->flash('raspored',['success','Uspešno izbrisan raspored!']);
        return redirect()->route('raspored');
    }

    // Kreiramo niz vrednosti iz forme za raspored casova
    private function kreirajNiz($broj,$dan,$polje,Request $req){
        if($broj>0){
            for($i=1;$i<=$broj;$i++){
                $imeNiza=$dan.$i;
                foreach($req->input() as $key=>$value){
                    if($key==$imeNiza){
                        $element=implode(',',$value);
                        if($i!=$broj){
                            $element=$element.'.';
                        }
                        $polje.=$element;
                    }
                }

            }
        } else {
            $polje='Nema predavanja';
        }
        return $polje;

    }

    // Kreiramo niz vrednosti iz forme za raspored casova
    private function rastaviNiz($rasporedi){
        $week=['ponedeljak','utorak','sreda','cetvrtak','petak'];
        foreach($rasporedi as $raspored){
            foreach($week as $dan){
                $raspored1=[];
                if($raspored->$dan!='Nema predavanja'){
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
