<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $potpis
 * @property string $obavestenje
 * @property string $datum
 * @property User $user
 */
class Obavestenje extends Model
{
    public $timestamps = false;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'obavestenja';

    /**
     * @var array
     */
    protected $fillable = ['potpis', 'naslov', 'obavestenje', 'datum','odobrenje'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'potpis', 'role');
    }
}
