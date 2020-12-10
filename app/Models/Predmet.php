<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $sifra
 * @property string $naziv
 * @property integer $godina_studija
 * @property int $espb
 * @property string $obavezni_izborni
 */
class Predmet extends Model
{
    public $timestamps = false;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'predmeti';

    /**
     * @var array
     */
    protected $fillable = ['sifra', 'naziv', 'godina_studija', 'espb', 'obavezni_izborni'];

}
