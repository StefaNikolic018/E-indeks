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
});

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

Route::group(['middleware' => ['auth','can:isAdmin']], function() {

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




    });

    // Korisnici
    Route::prefix('korisnici')->group(function(){
        Route::get('/', [App\Http\Controllers\KorisnikController::class, 'index'])->name('korisnici');

        Route::match(['get','post'],'novi_korisnik',[App\Http\Controllers\KorisnikController::class, 'novi_korisnik'])->name('novi_korisnik');

        Route::match(['get','post'],'izmena_korisnika/{id}',[App\Http\Controllers\KorisnikController::class, 'izmena_korisnika'])->name('izmena_korisnika');

        Route::post('brisanje_korisnika/{id}',[App\Http\Controllers\KorisnikController::class,'brisanje_korisnika'])->name('brisanje_korisnika');




    });




});

    Route::get('/logout', function(Request $req){
        if(Auth::check()){
            Auth::logout();
            $req->session()->flash('login',['success','Uspešno ste izlogovani!']);
            return redirect()->route('login');
        }

    })->middleware('auth');



