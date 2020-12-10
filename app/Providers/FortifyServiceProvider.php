<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use Illuminate\Support\ServiceProvider;
use Laravel\Fortify\Fortify;

class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Fortify::createUsersUsing(CreateNewUser::class);
        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);

        // Fortify::authenticateUsing(function (Request $request) {
        //     $user = User::where('email', $request->email)->first();

        //     if ($user){
        //         if(Hash::check($request->password, $user->password)){
        //             return $user;
        //         }
        //         return back()->withErrors(['password','Pogrešna šifra!'])->withInput();
        //     }
        //     return back()->withErrors(['email','Korisnik sa ovim email-om ne postoji!'])->withInput();
        // });

        Fortify::loginView(function(){
            return view('auth.login');
        });

        Fortify::registerView(function(){
            return view('auth.register');
        });
    }
}
