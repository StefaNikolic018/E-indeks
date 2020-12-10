<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'ime',
        'prezime',
        'email',
        'password',
        'role',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];


    // Determines which role
    // public function isAdmin($id){
    //     $role=self::where('id',$id)->first('role');
    //     if($role=='admin'){
    //         return true;
    //     }
    //     return false;
    // }

    // public function isUser($id){
    //     $role=self::where('id',$id)->first('role');
    //     if($role=='user'){
    //         return true;
    //     }
    //     return false;
    // }

    // /**
    //  * The attributes that should be cast to native types.
    //  *
    //  * @var array
    //  */
    // protected $casts = [
    //     'email_verified_at' => 'datetime',
    // ];
}
