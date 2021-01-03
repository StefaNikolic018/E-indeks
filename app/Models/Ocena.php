<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $student_id
 * @property int $predmet_id
 * @property float $ocena
 * @property string $datum
 */
class Ocena extends Model
{
    public $timestamps = false;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'ocene';

    /**
     * @var array
     */
    protected $fillable = ['student_id', 'predmet_id', 'ocena', 'datum','student_predmet'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function predmet()
    {
        return $this->belongsTo(Predmet::class, 'predmet_id', 'id');
    }

}
