<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $email_korisnika
 * @property string $ime
 * @property string $prezime
 * @property string $smer
 * @property string $zvanje
 * @property string $bio
 * @property string $datum_rodjenja
 * @property string $datum_zaposljenja
 * @property User $user
 */
class Profesor extends Model
{
    public $timestamps = false;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'profesori';

    /**
     * @var array
     */
    protected $fillable = ['email_korisnika', 'ime', 'prezime', 'predmeti', 'zvanje', 'bio', 'datum_rodjenja', 'datum_zaposljenja'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'email_korisnika', 'email');
    }
}
