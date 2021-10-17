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
use App\Models\Dogadjaj;

class RasporedIspitaController extends Controller
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
        $rasporedi=Raspored::all();
        $rasporedi=$this->rastaviNiz($rasporedi);
        $predmeti=Predmet::all();
        $dogadjaji=Dogadjaj::all();
        $dogadjaji=$this->formatDatuma($dogadjaji);

        if(Auth::user()->role=='user'){
            return view('studenti.kalendar',['rasporedi'=>$rasporedi,'predmeti'=>$predmeti,'dogadjaji'=>$dogadjaji]);
        }

        return view('admin.raspored.raspored',['rasporedi'=>$rasporedi,'predmeti'=>$predmeti,'dogadjaji'=>$dogadjaji]);
    }



    /**
     * Shows the adding students panel
     */
    public function novi_dogadjaj(Request $req){
        // if($req->method()=='GET'){
        //     $predmeti=Predmet::all();
        //     $smerovi = Smer::all();
        //     return view('admin.raspored.novi_raspored',['smerovi'=>$smerovi,'predmeti'=>$predmeti]);
        // }
        // $ponedeljak=$req->ponedeljak;
        // $pon=$this->kreirajNiz($ponedeljak,'Ponedeljak','',$req);
        // $utorak=$req->utorak;
        // $uto=$this->kreirajNiz($utorak,'Utorak','',$req);
        // $sreda=$req->sreda;
        // $sre=$this->kreirajNiz($sreda,'Sreda','',$req);
        // $cetvrtak=$req->cetvrtak;
        // $cet=$this->kreirajNiz($cetvrtak,'Četvrtak','',$req);
        // $petak=$req->petak;
        // $pet=$this->kreirajNiz($petak,'Petak','',$req);


        // $input=['smer'=>$req->smer,'godina_studija'=>$req->godina_studija,'ponedeljak'=>$pon,'utorak'=>$uto,'sreda'=>$sre,'cetvrtak'=>$cet,'petak'=>$pet];


        // // Validator
        // $validator=Validator::make($input,[
        //     'smer'=>'required',
        //     'godina_studija'=>'required|numeric',
        // ]);
        $input=['naslov'=>$req->naslov,'predmet'=>$req->predmet,'godina_studija'=>$req->godina_studija,'izbor'=>$req->izbor,'pocetak'=>$req->pocetak,'zavrsetak'=>$req->zavrsetak,'boja'=>$req->boja,'ceo_dan'=>$req->ceo_dan];

        // Validator
        $validator=Validator::make($input,[
            'naslov'=>'required|string',
            'predmet'=>'required|numeric',
            'godina_studija'=>'required|numeric',
            'izbor'=>'required|string',
            'pocetak'=>'required|date',
            'zavrsetak'=>'required|date',
            'boja'=>'required',
            'ceo_dan'
        ]);
        // Ako polja nisu validna
        if($validator->fails()){
            $req->session()->flash('raspored_ispita',['danger','Neispravno popunjena polja!']);
            return back();
            // return back()->withErrors($validator)->withInput();
        }
        // Ako jesu
        Dogadjaj::create($input);
        $req->session()->flash('raspored_ispita',['success','Uspešno dodat događaj!']);
        return redirect()->route('raspored_ispita');
        }


    // /**
    //  * Shows individual student
    //  */
    // public function raspored($id){
    //     $raspored=Raspored::where('id',$id)->get();
    //     $raspored=$this->rastaviNiz($raspored);
    //     $raspored1=Raspored::find($id);
    //     foreach($raspored as $raspored){
    //         $raspored1->ponedeljak=$raspored->ponedeljak;
    //         $raspored1->utorak=$raspored->utorak;
    //         $raspored1->sreda=$raspored->sreda;
    //         $raspored1->cetvrtak=$raspored->cetvrtak;
    //         $raspored1->petak=$raspored->petak;

    //     }

    //     // dd($raspored);

    //     return view('admin.raspored.jedan',['raspored'=>$raspored1]);

    // }

    /**
     * Updating students info
     */
    // TODO
    public function izmena_dogadjaja($id,Request $req){
        if($req->id){
            $input=['pocetak'=>$req->pocetak,'zavrsetak'=>$req->zavrsetak];
        } else {
            $input=['naslov'=>$req->naslov,'predmet'=>$req->predmet,'godina_studija'=>$req->godina_studija,'izbor'=>$req->izbor,'pocetak'=>$req->pocetak,'zavrsetak'=>$req->zavrsetak,'boja'=>$req->boja,'ceo_dan'=>$req->ceo_dan];

            // Validator
            $validator=Validator::make($input,[
                'naslov'=>'required|string',
                'predmet'=>'required|numeric',
                'godina_studija'=>'required|numeric',
                'izbor'=>'required|string',
                'pocetak'=>'required|date',
                'zavrsetak'=>'required|date',
                'boja'=>'required',
                'ceo_dan'
            ]);
            // Ako polja nisu validna
            if($validator->fails()){
                $req->session()->flash('raspored_ispita',['danger','Neispravno popunjena polja!']);
                return back();
                // return back()->withErrors($validator)->withInput()->with('dogadjaj_id',$id);
            }
        }
        // Ako jesu
        Dogadjaj::where('id',$id)->update($input);
        $req->session()->flash('raspored_ispita',['success','Uspešno izmenjen događaj!']);
        return redirect()->route('raspored_ispita');
    }

    /**
     * Deleting the student
     */
    public function brisanje_dogadjaja($id, Request $req){
        Dogadjaj::where('id',$id)->delete();
        $req->session()->flash('raspored_ispita',['success','Uspešno izbrisan događaj!']);
        return redirect()->route('raspored_ispita');
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

    private function formatDatuma($dogadjaji){
        $niz=['pocetak','zavrsetak'];
        foreach($dogadjaji as $dogadjaj){
            foreach($niz as $polje){
                $dan=substr($dogadjaj->$polje,0,strpos($dogadjaj->$polje,'.')+1);
                $ostatak=substr($dogadjaj->$polje,strlen($dan),strlen($dogadjaj->$polje));
                $mesec=substr($ostatak,0,strpos($ostatak,'.')+1);
                $mesecDan=$mesec.$dan;
                $datum=$mesec.$dan.substr($dogadjaj->$polje,strlen($mesecDan));
                $dogadjaj->$polje=$datum;
            }
        }
        return $dogadjaji;
    }
}
