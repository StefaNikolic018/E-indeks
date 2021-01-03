<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $ime
 * @property string $ime_roditelja
 * @property string $prezime
 * @property string $broj_indeksa
 * @property int $godina_studija
 * @property int $jmbg
 * @property string $datum_rodjenja
 * @property int $espb
 * @property float $prosek_ocena
 * @property int $broj_telefona
 * @property string $email
 */
class Student extends Model
{
    public $timestamps = false;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'studenti';

    /**
     * @var array
     */
    protected $fillable = ['ime', 'ime_roditelja', 'prezime', 'broj_indeksa', 'godina_studija', 'jmbg', 'datum_rodjenja', 'espb', 'prosek_ocena', 'broj_telefona', 'email','smer'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function smers()
    {
        return $this->belongsTo(Smer::class,'smer','id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'email', 'email');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function ocene()
    {
        return $this->hasMany(Ocena::class, 'student_id', 'id');
    }

    // /**
    //  * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
    //  */
    // public function predmet()
    // {
    //     return $this->hasManyThrough(
    //         Ocena::class,
    //         Predmet::class,
    //         'predmet_id',
    //         '',
    //         'student_id',
    //         'id'

    //     );
    // }

    // URADITI HAS MANY THROUGH ZA PREDMETE IZ KOJIH SU OCENE,
    // ZNACI KORISTITI PREDMETE I OCENE I NJIHOVE KLJUCEVE

}
