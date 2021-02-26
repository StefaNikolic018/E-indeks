<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $smer
 * @property int $godina_studija
 * @property string $ponedeljak
 * @property string $utorak
 * @property string $sreda
 * @property string $cetvrtak
 * @property string $petak
 * @property Smerovi $smerovi
 */
class Raspored extends Model
{
    public $timestamps=false;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'raspored';


    /**
     * @var array
     */
    protected $fillable = ['smer', 'godina_studija', 'ponedeljak', 'utorak', 'sreda', 'cetvrtak', 'petak'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function smerovi()
    {
        return $this->belongsTo(Smer::class, 'smer','id');

    }
}
