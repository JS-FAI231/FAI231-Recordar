<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Style
 *
 * @property $id
 * @property $gender_id
 * @property $estilo
 * @property $created_at
 * @property $updated_at
 *
 * @property Gender $gender
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Style extends Model
{
    
    static $rules = [
    ];

    protected $perPage = 5;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['gender_id','estilo'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function gender()
    {
        return $this->hasOne('App\Models\Gender', 'id', 'gender_id');
    }
    

}
