<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $naziv
 * @property string $opis
 * @property int $espb
 * @property string $akreditovan
 * @property string $predmeti
 */
class Smer extends Model
{
    public $timestamps=false;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'smerovi';

    /**
     * @var array
     */
    protected $fillable = ['naziv', 'opis', 'espb', 'akreditovan', 'predmeti'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function student()
    {
        return $this->hasMany(Student::class, 'smer','id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function predmeti()
    {
        return $this->hasMany(Predmet::class, 'smerovi','id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function raspored()
    {
        return $this->hasMany(Raspored::class, 'smer','id');
    }

}
