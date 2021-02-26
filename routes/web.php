<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\Models\Predmet;
use App\Models\Student;
use App\Models\Ocena;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    if(Auth::check()){
        if(Auth::user()->role=='admin'){
            return redirect()->route('studenti');
        } elseif (Auth::user()->role=='superAdmin'){
            return redirect()->route('pocetna');
        } elseif (Auth::user()->role=='user'){
            $email=Auth::user()->email;
            $ime=Student::where('email',$email)->value('ime');
            return redirect()->route('profil',['ime'=>$ime]);
        }
    }
    return view('auth.login');
})->name('/');

Route::fallback(function(Request $req){
    if(Auth::check()){
        if(Auth::user()->role=='admin'){
            return redirect()->route('studenti');
        } elseif (Auth::user()->role=='user') {
            $email=Auth::user()->email;
            $ime=Student::where('email',$email)->value('ime');
            return redirect()->route('profil',['ime'=>$ime]);
        } elseif (Auth::user()->role='superAdmin'){
            return redirect()->route('pocetna');
        }
    }
    $req->session()->flash('login',['danger','Stranica ne postoji :( ']);
    return redirect()->route('login');
});

Route::group(['middleware' => ['auth','can:isSuperAdmin']], function() {

    // Ocene
    Route::prefix('ocene')->group(function(){
        Route::get('/', [App\Http\Controllers\OcenaController::class, 'index'])->name('ocene');

        Route::post('dodaj_ocenu/{id}',[App\Http\Controllers\OcenaController::class,'dodaj_ocenu'])->name('dodaj_ocenu');

        Route::match(['get','post'],'ocena_izmena/{id}/{id1}',[App\Http\Controllers\OcenaController::class,'ocena_izmena'])->name('ocena_izmena');

        Route::post('ocena_brisanje/{id}/{id1}',[App\Http\Controllers\OcenaController::class,'ocena_brisanje'])->name('ocena_brisanje');

    });


});

Route::group(['middleware' => ['auth','can:isUser']], function() {
    Route::prefix('profil')->group(function(){

        Route::get('/{ime}',[App\Http\Controllers\StudentController::class,'index'])->name('profil');
        // Route::view('/','studenti.profil',['studenti'=>Student::all(),'predmeti'=>Predmet::all(),'ocene'=>Ocena::all()])->name('profil');

    });




});

Route::group(['middleware' => ['auth','can:isSuperAdmin']], function() {
    // Pocetna
    Route::prefix('pocetna')->group(function(){

        Route::get('/',[App\Http\Controllers\AdminController::class,'index'])->name('pocetna');

    });
    // Studenti
    Route::prefix('studenti')->group(function(){

        Route::view('/','admin.studenti.studenti',['stud'=>Student::all()])->name('studenti');

        Route::match(['get','post'],'novi_student',[App\Http\Controllers\HomeController::class,'novi_student'])->name('novi_student');

        Route::get('student/{id}',[App\Http\Controllers\HomeController::class,'student'])->name('student');

        Route::match(['get','post'],'izmena_studenta/{id}',[App\Http\Controllers\HomeController::class,'izmena_studenta'])->name('izmena_studenta');

        Route::post('brisanje_studenta/{id}',[App\Http\Controllers\HomeController::class,'brisanje_studenta'])->name('brisanje_studenta');

    });

    // Predmeti
    Route::prefix('predmeti')->group(function(){

        Route::view('/','admin.predmeti.predmeti',['predmeti'=>Predmet::all()])->name('predmeti');


        Route::match(['get','post'],'novi_predmet',[App\Http\Controllers\PredmetController::class,'novi_predmet'])->name('novi_predmet');

        Route::match(['get','post'],'izmena_predmeta/{id}',[App\Http\Controllers\PredmetController::class,'izmena_predmeta'])->name('izmena_predmeta');

        Route::post('brisanje_predmeta/{id}',[App\Http\Controllers\PredmetController::class,'brisanje_predmeta'])->name('brisanje_predmeta');

        Route::match(['get','post'],'kopiranje_predmeta/{id}',[App\Http\Controllers\PredmetController::class,'kopiranje_predmeta'])->name('kopiranje_predmeta');




    });

    // Korisnici
    Route::prefix('korisnici')->group(function(){
        Route::get('/', [App\Http\Controllers\KorisnikController::class, 'index'])->name('korisnici');

        Route::match(['get','post'],'novi_korisnik',[App\Http\Controllers\KorisnikController::class, 'novi_korisnik'])->name('novi_korisnik');

        Route::match(['get','post'],'izmena_korisnika/{id}',[App\Http\Controllers\KorisnikController::class, 'izmena_korisnika'])->name('izmena_korisnika');

        Route::post('brisanje_korisnika/{id}',[App\Http\Controllers\KorisnikController::class,'brisanje_korisnika'])->name('brisanje_korisnika');




    });

    //Profesori
    Route::prefix('profesori')->group(function(){
        Route::get('/',[App\Http\Controllers\ProfesorController::class,'index'])->name('profesori');


        Route::match(['get','post'],'novi_profesor',[App\Http\Controllers\ProfesorController::class,'novi_profesor'])->name('novi_profesor');

        Route::get('profesor/{id}',[App\Http\Controllers\ProfesorController::class,'profesor'])->name('profesor');

        Route::match(['get','post'],'izmena_profesora/{id}',[App\Http\Controllers\ProfesorController::class,'izmena_profesora'])->name('izmena_profesora');

        Route::post('brisanje_profesora/{id}',[App\Http\Controllers\ProfesorController::class,'brisanje_profesora'])->name('brisanje_profesora');


    });

    //Obavestenja
    Route::prefix('obavestenja')->group(function(){
        Route::get('/',[App\Http\Controllers\ObavestenjeController::class,'index'])->name('obavestenja');


        Route::match(['get','post'],'novo_obavestenje',[App\Http\Controllers\ObavestenjeController::class,'novo_obavestenje'])->name('novo_obavestenje');

        Route::get('obavestenje/{id}',[App\Http\Controllers\ObavestenjeController::class,'obavestenje'])->name('obavestenje');

        Route::match(['get','post'],'izmena_obavestenja/{id}',[App\Http\Controllers\ObavestenjeController::class,'izmena_obavestenja'])->name('izmena_obavestenja');

        Route::post('brisanje_obavestenja/{id}',[App\Http\Controllers\ObavestenjeController::class,'brisanje_obavestenja'])->name('brisanje_obavestenja');

        Route::get('odobrenje_obavestenja/{id}/{odobrenje}',[App\Http\Controllers\ObavestenjeController::class,'odobrenje_obavestenja'])->name('odobrenje_obavestenja');


    });

    //Smerovi
    Route::prefix('smerovi')->group(function(){
        Route::get('/',[App\Http\Controllers\SmerController::class,'index'])->name('smerovi');

        Route::match(['get','post'],'novi_smer',[App\Http\Controllers\SmerController::class,'novi_smer'])->name('novi_smer');

        Route::get('smer/{id}',[App\Http\Controllers\SmerController::class,'smer'])->name('smer');

        Route::match(['get','post'],'izmena_smera/{id}',[App\Http\Controllers\SmerController::class,'izmena_smera'])->name('izmena_smera');

        Route::post('brisanje_smera/{id}',[App\Http\Controllers\SmerController::class,'brisanje_smera'])->name('brisanje_smera');

    });

    Route::prefix('raspored')->group(function(){
        Route::get('/',[App\Http\Controllers\RasporedController::class,'index'])->name('raspored');

        Route::match(['get','post'],'novi_raspored',[App\Http\Controllers\RasporedController::class,'novi_raspored'])->name('novi_raspored');

        Route::match(['get','post'],'izmena_rasporeda/{id}',[App\Http\Controllers\RasporedController::class,'izmena_rasporeda'])->name('izmena_rasporeda');

        Route::get('jedan/{id}',[App\Http\Controllers\RasporedController::class, 'raspored'])->name('jedan');

        Route::post('brisanje_rasporeda/{id}',[App\Http\Controllers\RasporedController::class,'brisanje_rasporeda'])->name('brisanje_rasporeda');


    });

    // Kreiraj kontroler za raspored ispita i kolokvijuma
    Route::prefix('raspored_ispita')->group(function(){
        Route::get('/',[App\Http\Controllers\RasporedIspitaController::class,'index'])->name('raspored_ispita');

        Route::match(['get','post'],'novi_raspored',[App\Http\Controllers\RasporedIspitaController::class,'novi_raspored'])->name('novi_dogadjaj');

        Route::match(['get','post'],'izmena_rasporeda/{id}',[App\Http\Controllers\RasporedIspitaController::class,'izmena_rasporeda'])->name('izmena_rasporeda');

        Route::get('jedan/{id}',[App\Http\Controllers\RasporedIspitaController::class, 'raspored'])->name('jedan');

        Route::post('brisanje_rasporeda/{id}',[App\Http\Controllers\RasporedIspitaController::class,'brisanje_rasporeda'])->name('brisanje_rasporeda');


    });



});


    Route::get('/logout', function(Request $req){
        if(Auth::check()){
            Auth::logout();
            $req->session()->flash('login',['success','Uspešno ste izlogovani!']);
            return redirect()->route('login');
        }

    })->middleware('auth');



