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
    protected $fillable = ['ime', 'ime_roditelja', 'prezime', 'broj_indeksa', 'godina_studija', 'jmbg', 'datum_rodjenja', 'espb', 'prosek_ocena', 'broj_telefona', 'email'];

}
