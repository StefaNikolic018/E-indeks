<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\Student;
use App\Models\Predmet;
use App\Models\Ocena;
use App\Models\User;


class KorisnikController extends Controller
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
        $korisnici=User::all();
        return view('admin.korisnici.korisnici',['korisnici'=>$korisnici]);
    }

    public function novi_korisnik(Request $req){
        if($req->method()=='GET'){
            return view('admin.korisnici.novi_korisnik');
        }
        // TODO User::create($input)
        $input=['ime'=>$req->ime,
                'prezime'=>$req->prezime,
                'email'=>$req->email,
                'password'=>$req->password,
                'uloga'=>$req->uloga];
        $validator=Validator::make($input, [
            'ime' => ['required', 'string', 'max:255'],
            'prezime' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', "unique:users,email"],
            'password' => ['required', 'string', 'min:6'],
            'uloga'=>['required']
        ]);

        if($validator->fails()){
            return back()->withErrors($validator)->withInput();
        }

        User::create([
            'ime' => $req->ime,
            'prezime' => $req->prezime,
            'email' => $req->email,
            'password' => Hash::make($req->password),
            'role'=>$req->uloga
        ]);

        $req->session()->flash('korisnik',['success','Uspešno dodat korisnik '.$req->ime.'!']);
        return redirect()->route('korisnici');

    }

    public function izmena_korisnika($id,Request $req){
        if($req->method()=='GET'){
            return view('admin.korisnici.izmena_korisnika',['korisnik'=>User::where('id',$id)->first()]);
        }
        // TODO User::where('id',$id)->update($input)
        $input=['ime'=>$req->ime,
                'prezime'=>$req->prezime,
                'email'=>$req->email,
                'password'=>$req->password,
                // 'role'=>$req->uloga
            ];

        $validator=Validator::make($input, [
            'ime' => ['required', 'string', 'max:255'],
            'prezime' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255',"unique:users,email,{$id}"],
            'password' => ['required', 'string', 'min:6'],
            // 'uloga'=>['required']
        ]);

        if($validator->fails()){
            return back()->withErrors($validator)->withInput();
        }

        User::where('id',$id)->update([
            'ime' => $req->ime,
            'prezime' => $req->prezime,
            'email' => $req->email,
            'password' => Hash::make($req->password),
            'role'=>$req->uloga
        ]);

        $req->session()->flash('korisnik',['success','Uspešno izmenjen korisnik '.$req->ime.'!']);
        return redirect()->route('korisnici');


    }

    public function brisanje_korisnika($id,Request $req){
        User::where('id',$id)->delete();

        $req->session()->flash('korisnik',['success','Uspešno obrisan korisnik!']);
        return redirect()->route('korisnici');

    }

}
