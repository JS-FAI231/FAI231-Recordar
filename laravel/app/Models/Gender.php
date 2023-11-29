<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Gender
 *
 * @property $id
 * @property $genero
 * @property $created_at
 * @property $updated_at
 *
 * @property Style[] $styles
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Gender extends Model
{
    
    static $rules = [
    ];

    protected $perPage = 5;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['genero'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function styles()
    {
        return $this->hasMany('App\Models\Style', 'gender_id', 'id');
    }
    

}
