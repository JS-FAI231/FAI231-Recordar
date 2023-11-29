<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Track
 *
 * @property $id
 * @property $title_id
 * @property $track
 * @property $nombre
 * @property $duracion
 * @property $path
 * @property $filename
 * @property $created_at
 * @property $updated_at
 *
 * @property Title $title
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Track extends Model
{
    
    static $rules = [
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['title_id','track','nombre','duracion','path','filename'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function title()
    {
        return $this->hasOne('App\Models\Title', 'id', 'title_id');
    }
    

}
