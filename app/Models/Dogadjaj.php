<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $predmet
 * @property string $naslov
 * @property int $godina_studija
 * @property string $izbor
 * @property string $pocetak
 * @property string $zavrsetak
 * @property string $boja
 * @property Predmeti $predmeti
 */
class Dogadjaj extends Model
{
    public $timestamps = false;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'dogadjaji';

    /**
     * @var array
     */
    protected $fillable = ['predmet', 'naslov', 'godina_studija', 'izbor', 'pocetak', 'zavrsetak', 'boja', 'ceo_dan'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function predmeti()
    {
        return $this->belongsTo('App\Models\Predmet', 'predmet');
    }
}
