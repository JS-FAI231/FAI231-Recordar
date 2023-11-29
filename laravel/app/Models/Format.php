<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Format
 *
 * @property $id
 * @property $formato
 * @property $descripcion
 * @property $created_at
 * @property $updated_at
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Format extends Model
{
    
    static $rules = [
    ];

    protected $perPage = 10;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['formato','descripcion'];



}
